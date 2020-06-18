<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
class Welcome extends CI_Controller {

	// protected $request;
	// public function __construct(){
	// 	parent::__construct();
	// 	$this->request= \Config\Services::request();
	// }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		return $this->load->view('welcome_message');
	}
	public function loadform(){
		$data['title']="form";
		
		 $this->load->view('form',$data);
		
		 return;

	}
	public function post(){
		// echo "<pre>";
		// var_dump($_FILES["input_file"]);
		// echo "</pre>";
		// exit();
		if (!is_dir('upload/')) {
			mkdir('./upload/', 0777, TRUE);
		
		}
		$data=["password"=>$this->input->post("password"),"email"=>$this->input->post("email")];
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'gif|jpg|png';
		// $config['max_size']     = '100';
		// $config['max_width'] = '1024';
		// $config['max_height'] = '768';
		$this->load->library('upload',$config);
		// $data['file']=$this->input->input_stream("file");
		// var_dump($data['file']);
		// exit(1);
		// $data['size']=$this->request->getFile('file')->getSize();
		// $data['name']=$this->request->getFile('file')->getName();
		// $data['random_name']=$this->request->getFile('file')->getRandomName();
		// $data['extension']=$this->request->getFile('file')->getExtension();
		// $data['type']=$this->request->getFile('file')->getType();
		// $this->load->model("author");
		// $this->load->library("mcarbon");
		// $headers=[
		// 	 "x-auth"=>"ok",
		// 	 "expires_in"=>$this->mcarbon::now("Asia/Dhaka")->format("H:i:s")
		// ];
		// $headers=$this->input->input_stream('file');
		// echo $headers;

		if ( ! $this->upload->do_upload("input_file"))
		{
				$error = array('error' => $this->upload->display_errors());

				return json_response($error,400);
		}
		else
		{
				$data = array('upload_data' => $this->upload->data());

				return json_response($data);
		}
		

		
	}
}
