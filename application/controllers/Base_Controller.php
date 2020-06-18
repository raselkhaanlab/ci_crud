<?php
class Base_Controller extends CI_Controller{
    public $request_method;
    public $accept_method;
    protected $all_functions;
    protected $http_map_functions =[];
    public function __construct(){
        parent::__construct();
        $this->request_method=get_request_method();
        $this->accept_method="get";
        $this->all_functions = $this->my_methods();
    }
    protected function method_check(){
            
        }
    protected function my_methods(){
       $methods= array_values(get_class_methods($this));
       unset($methods[0]);
       return array_values($methods);

    }
}