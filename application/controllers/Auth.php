<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends Base_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("user_model");
        
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
        $this->customrequest->is_post_or_redirect('login');
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
                redirect("/login");
                return;
            }

            if(!$this->user_model->is_exists('email',$input['email'])){
                $_SESSION['errors']['email']="email not exists";
                redirect("/login");
                return;
            }
            if(!$this->user_model->is_exists('password',$input['password'])){
                $_SESSION['errors']['password']="wrong password";
                redirect("/login");
                return;
            }
            $logininfo=$this->user_model->verify_auth($input['email'],$input['password']);
            if(!logininfo){
                $_SESSION['errors']['password']="log in failed";
                redirect("/login");
                return;
            }
            $_SESSION['user']=$logininfo;
            redirect('/author');
    }

    public function logout(){
        $this->authcheck->redirect_if_not_authenticate("login");
        $url="author";
        $this->customrequest->is_post_or_redirect($url);
       $this->session->unset_userdata("user");
       $_SESSION['success']="logout successfull";
       redirect("login");
    }
    public function registration(){
        $url="registration";
        $this->authcheck->redirect_if_authenticate("author");
        $this->customrequest->is_post_or_redirect($url);
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
                    redirect("/registration");
                    return;
                }
            $id=$this->user_model->registration($input);
            if(!isset($id)){
                $_SESSION['fail']="Registration failed";
                $_SESSION['old']=$input;
                return redirect('/registraion');
            }
           $this->session->set_userdata(['success'=>"Registration success"]);
            return redirect('/login');
    }
}