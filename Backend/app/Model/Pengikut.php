<?php 

require_once '../Backend/Database/Connection.php';


class Pengikut{
    protected $db;
    public function __construct()
    {
        $this->db = new Connection;
    }
    
    public function insertFollowing($id1, $id2){
        $this->db->query('INSERT INTO pengikut (mengikuti_id, diikuti_id) VALUES(:mengikuti, :diikuti)');
        $this->db->bind('mengikuti', $id1);
        $this->db->bind('diikuti', $id2);
        $this->db->execute();
     }
     public function deleteFollowing($id1, $id2){
          $this->db->query('DELETE FROM pengikut WHERE mengikuti_id=:id1 AND diikuti_id=:id2');
          $this->db->bind('id1', $id1);
          $this->db->bind('id2', $id2);
          $this->db->execute();
     }
     public function getFollowing($id1, $id2){
          $this->db->query('SELECT * FROM pengikut WHERE mengikuti_id=:id1 AND diikuti_id=:id2');
          $this->db->bind('id1', $id1);
          $this->db->bind('id2', $id2);
          return $this->db->single();
     }
     

}

?>