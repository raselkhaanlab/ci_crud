<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authcheck {
    public function redirect_if_not_authenticate($redirect_url){
        if(!isset($_SESSION['user'])){
            $uri=isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:$redirect_url;
            redirect($uri);
        }
    }
    public function redirect_if_authenticate($redirect_url){
        if(isset($_SESSION['user'])){
            $uri=isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:$redirect_url;
            redirect($uri);
        }
    }
}