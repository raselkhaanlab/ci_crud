<?php
class Author_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
   public function all(){
    //    
       $query= $this->db->get("authors");
       return $query;
   } 
   public function get_by_id($id){
       $this->db->where("id",$id);
       $query= $this->db->get("authors");
       return $query;
   } 
   public function update($id,$data){
       $this->db->where("id",$id);
       $query= $this->db->update("authors",$data);
       return $query;
   } 
   public function insert($data){
       $query= $this->db->insert("authors",$data);
       $query?$this->session->set_flashdata("message","add successfull"):$this->session->set_flashdata("message","add failed");
       redirect("/author");
   } 

   function row_delete($id)
{
   $this->db->where('id', $id);
   return $this->db->delete('authors'); 
}
    
}