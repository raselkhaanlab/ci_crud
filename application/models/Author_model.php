<?php
class Author_model extends MY_Model{
   protected $table="authors";
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
        if($this->db->affected_rows()<1){
            return FALSE;
        }
        return TRUE;
 
   } 
   public function insert($data){
       $query= $this->db->insert("authors",$data);
       if($this->db->affected_rows()<1){
        return FALSE;
    }
    return TRUE;
   } 

   function row_delete($id)
{
   $sql= $this->db->delete($this->table,['id'=>$id]);
   if($this->db->affected_rows()<1){
       return FALSE;
   }
   return TRUE;
}
    
}