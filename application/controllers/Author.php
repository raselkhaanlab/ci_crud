<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Author extends Base_Controller{
    public function __construct(){
        parent::__construct();
        $this->authcheck->redirect_if_not_authenticate("login");
        $this->load->model("author_model");
    }
 
    public function index(){
            $data['title']="Authors";
            $data['authors']=$this->author_model->all()->result_array();
            // print_r($data['authors']);
             $this->load->view("author/index",$data);
    }
    public function add(){
        $data['title']="Author add";
        $data['errors']=isset($_SESSION['errors'])?$_SESSION['errors']:[];
        $data['old']= isset($_SESSION['old'])?$_SESSION['old']:[];
         unset($_SESSION['errors']);
         unset($_SESSION['old']);
         method_not_found($this);
         $this->load->view("author/add",$data);
    }
    public function post_add(){
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
        redirect("/author");
        return;
    }
    public function edit(){
        $data['title']="Author edit";
        $id=$this->uri->segment(3);
        if(!$id){
            $this->customrequest->redirect_if_invalid('author');
        }
        $data['errors']=isset($_SESSION['errors'])?$_SESSION['errors']:[];
         unset($_SESSION['errors']);
        $data["author"]=$this->author_model->get_by_id($id)->result_array()[0];
        $this->load->view("author/edit",$data);
    }
    public function post_edit(){
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
            redirect("/author/edit/".$id);
           return;
        }
        $result=$this->author_model->update($id,$input);
        // var_dump($result);
        // exit();
        if($result){
            $this->session->set_flashdata("message","update success");
        }
        else{
            $this->session->set_flashdata("message","update fail");
        }
        redirect('/author');
    }
    public function delete(){
        $uri="author";
        $this->customrequest->is_post_or_redirect($url);
        $id=$this->uri->segment(3);
        if(!$id){
            $this->customrequest->redirect_if_invalid('author');
        }
        $result=$this->author_model->row_delete($id);
        if($result){
            $this->session->set_flashdata("message","delete success");
        }
        else{
            $this->session->set_flashdata("message","delete fail");
        }
        redirect('/author');
    }
}