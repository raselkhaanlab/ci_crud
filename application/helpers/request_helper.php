<?php
function get_request_method(){
    $tmp_method= strtolower($_SERVER["REQUEST_METHOD"]);
    if($tmp_method =="post"){
        if(array_key_exists('_method',$_POST) && $_POST['_method']){
            $tmp_method= strtolower($_POST['_method']);
        }
    }
    $method= $tmp_method;
    return $method;
    

}
function method_not_found($obj){
    $data=[];
    if($obj->request_method !== $obj->accept_method){
        $data['heading']="Method not found";
        $data['message']=$obj->request_method." "." is not allowed";
    }
    return $data;

}