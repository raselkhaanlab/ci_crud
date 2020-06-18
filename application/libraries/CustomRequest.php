<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CustomRequest {
    public function is_post_or_redirect($redirect_url){
        if($_SERVER["REQUEST_METHOD"] !="POST"){
           $uri=isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:$redirect_url;
            redirect($uri);
        }
    }
    public function redirect_if_invalid($redirect_url){
        $uri=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:$redirect_url;
        redirect($uri);
        return;
    }
}