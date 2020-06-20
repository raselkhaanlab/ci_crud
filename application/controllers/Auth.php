<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("user_model");
        
    }
    public function edit(){
        $data['title']="Edit account";
        $this->authcheck->redirect_if_not_authenticate("login");
        $data['errors']=isset($_SESSION['errors'])? $_SESSION['errors']:[];
        $data['old']= isset($_SESSION['old'])?$_SESSION['old']:[];
        $data["fail"]= isset($_SESSION['fail'])?$_SESSION['fail']:'';
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
        unset($_SESSION['fail']);
        $data['my_info']=$this->session->userdata('user');
        $this->load->view('edit',$data);
    }
    public function edit_post(){
        $id= +$this->session->userdata('user')['id'];
        $this->authcheck->redirect_if_not_authenticate("login");
        $input = $this->input->post();
        $validation_config=[
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[users.id!='.$id.' AND '.'email=]'
            ],
            [
                'field' => 'number',
                'label' => 'number',
                'rules' => 'trim|required|is_unique[users.id!='.$id.' AND '.'number=]'
            ],
            [
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|required|min_length[8]|max_length[20]'
            ]
            ];
            $this->form_validation->set_rules($validation_config);
            if ($this->form_validation->run() == FALSE)
                {
                    $_SESSION['errors']=$this->form_validation->error_array();
                    $_SESSION['old']=$input;
                    return redirect("edit/me");
                }
              
            $id=$this->user_model->update_me($input);
            if(!$id){
                $_SESSION['fail']="Your account edit unsuccessfull";
                // $_SESSION['old']=$input;
                return redirect('author');
            }
            $this->session->set_userdata(['success'=>"account edit successfully done!!"]);
            $this->session->set_userdata(["user"=>$this->user_model->get_by_id($this->session->userdata('user')['id'])->row_array()]);
            return redirect('author');
        
    }
    public function registration_form(){
        $data['title']="Registration";
        $this->authcheck->redirect_if_authenticate("author");
        $data['errors']=isset($_SESSION['errors'])? $_SESSION['errors']:[];
        $data['old']= isset($_SESSION['old'])?$_SESSION['old']:[];
        $data["fail"]= isset($_SESSION['fail'])?$_SESSION['fail']:'';
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
        unset($_SESSION['fail']);
        $this->load->view("registration",$data);
    }
    public function login_form(){
        $data['title']="Login";
        $this->authcheck->redirect_if_authenticate("author");
        $data["title"]="Login";
        $data['errors']=isset($_SESSION['errors'])? $_SESSION['errors']:[];
        $data['success']=$this->session->has_userdata("success")?$this->session->userdata("success"):"";
        unset($_SESSION['errors']);
        unset($_SESSION['success']);
        $this->load->view('login',$data);
    }
    public function login(){
        $this->authcheck->redirect_if_authenticate("author");
        $input= $this->input->post();
        $validation_config=[
            [
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email'
            ]
            ];
            $this->form_validation->set_rules($validation_config);
            if($this->form_validation->run()===FALSE){
                $_SESSION['errors']=$this->form_validation->error_array();
                return redirect("/login");
            }

            if(!$this->user_model->is_exists('email',$input['email'])){
                $_SESSION['errors']['email']="Email is not registered";
                return redirect("/login");
            }
            if(!$this->user_model->is_exists('password',$input['password'])){
                $_SESSION['errors']['password']="Incorrect password";
                return redirect("/login");
            }
            $logininfo=$this->user_model->verify_auth($input['email'],$input['password']);
            if(!logininfo){
                $_SESSION['errors']['password']="Login attempt failed";
               return redirect("/login");
            }
            $_SESSION['user']=$logininfo->row_array();
           return redirect('/author');
    }

    public function logout(){
        $this->authcheck->redirect_if_not_authenticate("login");
        $url="author";
       $this->session->unset_userdata("user");
       $_SESSION['success']="You Logged out successfully!!";
       return redirect("login");
    }
  
    public function registration(){
        $url="registration";
        $this->authcheck->redirect_if_authenticate("author");
        $input = $this->input->post();
        $validation_config=[
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[users.email]'
            ],
            [
                'field' => 'number',
                'label' => 'number',
                'rules' => 'trim|required|is_unique[users.number]'
            ],
            [
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|required|min_length[8]|max_length[20]'
            ]
            ];
            $this->form_validation->set_rules($validation_config);
            if ($this->form_validation->run() == FALSE)
                {
                    $_SESSION['errors']=$this->form_validation->error_array();
                    $_SESSION['old']=$input;
                    return redirect("/registration");
                }
            $id=$this->user_model->registration($input);
            if(!isset($id)){
                $_SESSION['fail']="Your Registration request unsuccessfull";
                $_SESSION['old']=$input;
                return redirect('/registraion');
            }
           $this->session->set_userdata(['success'=>"Your registration successfully done!!"]);
            return redirect('/login');
    }
}