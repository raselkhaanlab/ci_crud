<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Model extends CI_Model{
   protected $table;
   public function __construct(){
       parent::__construct();
       $this->load->database();
   }
   public function get_current_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);
 
        if ($query->num_rows() > 0) 
        {
            return $query;
        }
 
        return false;
    }
     
    public function get_total() 
    {
        return $this->db->count_all($this->table);
    }
    public function get_by_id($id){
        $this->db->where("id",$id);
        $query= $this->db->get($this->table);
        return $query;
    } 
}