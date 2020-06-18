<?php
class User_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
   public function registration ($data){
       $id=$this->db->insert('users',$data);
       return $id;
   }
   public function is_exists ($field,$email){
       $this->db->where($field,$email);
       $query= $this->db->get("users");
       if($query->num_rows()<1){
           return false;
       }
       return true;
   }
   public function verify_auth($email,$password){
       $query=$this->db->where('email',$email)
              ->where('password',$password)
              ->limit(1)
              ->get("users");
              if($query->num_rows()>0){
                  return $query->row();
              }
              return false;  
   }
    
}