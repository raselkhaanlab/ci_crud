<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Author extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->authcheck->redirect_if_not_authenticate("login");
        $this->load->model("author_model");
    }
 
    public function index(){
            $data['title']="Authors";
            $paginating_options=['limit'=>3,'base_url'=>'author/index'];
            $paginationResult=$this->custom_pagination("author_model",$paginating_options);
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
         unset($_SESSION['errors']);
         unset($_SESSION['old']);
         $this->load->view("author/add",$data);
    }
    public function post_add(){
        $url="author";
        $this->customrequest->is_post_or_redirect($url);
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
           return redirect("/author/add");
        }
        $result=$this->author_model->insert($input);
        $this->session->set_flashdata("message",'add success');
         return redirect("/author");
    }
    public function edit(){
        $data['title']="Author edit";
        $id=$this->uri->segment(3);
        if(!$id){
            $this->customrequest->redirect_if_invalid('author');
            return;
        }
        $data['errors']=isset($_SESSION['errors'])?$_SESSION['errors']:[];
         unset($_SESSION['errors']);
        $data["author"]=$this->author_model->get_by_id($id)->result_array()[0];
        $this->load->view("author/edit",$data);
    }
    public function post_edit(){
        $url="author";
        $this->customrequest->is_post_or_redirect($url);
        $id= $this->input->post('id');
        $input=$this->input->post();
        unset($input['id']);
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[authors.id!='.$id.' AND '.'email=]');
        $this->form_validation->set_rules('github', 'GitHub', 'required');
        $this->form_validation->set_rules('twitter', 'Twitter', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $_SESSION['errors']=$this->form_validation->error_array();
            return redirect("/author/edit/".$id);
        }
        $result=$this->author_model->update($id,$input);

        if($result){
            $this->session->set_flashdata("message","update success");
        }
        else{
            $this->session->set_flashdata("message","update fail");
        }
        return redirect('/author');
    }
    public function delete(){
        $url="author";
        $this->customrequest->is_post_or_redirect($url);
        $id=$this->uri->segment(3);
        if(!$id){
            $this->customrequest->redirect_if_invalid('author');
            return;
        }
        $result=$this->author_model->row_delete($id);
        if($result){
            $this->session->set_flashdata("message","delete success");
        }
        else{
            $this->session->set_flashdata("message","delete fail");
        }
        return redirect('/author');
    }
}