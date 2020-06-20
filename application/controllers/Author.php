<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Author extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->authcheck->redirect_if_not_authenticate("login");
        $this->load->model("author_model");
    }
 
    public function index($page=NULL){
            $data['title']="Authors";
            $paginating_options=['limit'=>3,'base_url'=>'author'];
            $paginationResult=$this->custom_pagination("author_model",$paginating_options);
            $data['success']=$this->session->has_userdata('success')?$this->session->userdata('success'):'';
            $data['fail']= $this->session->has_userdata('fail')?$this->session->userdata('fail'):'';
            $this->session->unset_userdata(['success'=>'','fail'=>'']);
            if(!$paginationResult){
                $data['authors']=0;
                $data['links']="";
                $data['total']=0;
            }
            else{
                $data['authors']=$paginationResult['results']->result_array();
                $data['links']=$paginationResult['links'];
                $data['total']=$this->author_model->get_total();  
            }
             $this->load->view("author/index",$data);
    }
    public function add(){
        $data['title']="Add Author";
        $data['errors']=isset($_SESSION['errors'])?$_SESSION['errors']:[];
        $data['old']= isset($_SESSION['old'])?$_SESSION['old']:[];
        $data['success']= isset($_SESSION['success'])?$_SESSION['success']:'';
         unset($_SESSION['errors']);
         unset($_SESSION['old']);
         unset($_SESSION['success']);
         $this->load->view("author/add",$data);
    }
    public function post_add(){
        $url="author";
        $input=$this->input->post();
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[authors.email]');
        $this->form_validation->set_rules('github', 'GitHub', 'trim|required|valid_url');
        $this->form_validation->set_rules('twitter', 'Twitter', 'trim|required|valid_url');
        $this->form_validation->set_rules('location', 'Location', 'required');
        if ($this->form_validation->run() == FALSE)
        {
           $_SESSION['errors']=$this->form_validation->error_array();
           $_SESSION['old'] =$input;
           return redirect("author/add");
        }
        $result=$this->author_model->insert($input);
        if($result){
            $_SESSION['success']="add author successfull";
        }
        else{
            $_SESSION['fail']="add author fail";
        }
         redirect("author");
    }
    public function edit($id){
        $data['title']="Author edit";
        $data['errors']=isset($_SESSION['errors'])?$_SESSION['errors']:[];
        $data['success']=isset($_SESSION['success'])?$_SESSION['success']:[];
        $data['fail']=isset($_SESSION['fail'])?$_SESSION['fail']:[];
         unset($_SESSION['errors']);
         unset($_SESSION['success']);
         unset($_SESSION['fail']);
         $q_result= $this->author_model->get_by_id($id)->row_array();
         
        if(!$q_result){
            return redirect('author');
        }
        $data['author']=$q_result;
        $this->load->view("author/edit",$data);
    }
    public function edit_author($id){
        $url="author";
        $input=$this->input->post();
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[authors.id!='.$id.' AND '.'email=]');
        $this->form_validation->set_rules('github', 'GitHub', 'required');
        $this->form_validation->set_rules('twitter', 'Twitter', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $_SESSION['errors']=$this->form_validation->error_array();
            return redirect("edit/author/".$id);
        }
        $result=$this->author_model->update($id,$input);

        if($result){
            $this->session->set_flashdata("success","Your update is successfull");
        }
        else{
            $this->session->set_flashdata("fail","No change,no update!");
        }
        return redirect('/author');
    }
    public function delete($id){
        $url="author";
        $result=$this->author_model->row_delete($id);
        if($result){
            $this->session->set_flashdata("success","Your delete is successfull");
        }
        else{
            $this->session->set_flashdata("fail","your delete is failed");
        }
        return redirect('author');
    }
}