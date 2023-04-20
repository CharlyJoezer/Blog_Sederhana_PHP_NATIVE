<?php 

require_once '../Backend/Database/Connection.php';


class Comment{
     protected $db;
     public function __construct()
     {
        $this->db = new Connection;
     }

     public function get($data){
          $this->db->query('SELECT usercomment_id,
                                   id_user,
                                   username,
                                   comment,
                                   foto_profil
                            FROM comment_postingan 
                            JOIN users ON comment_postingan.usercomment_id=users.id_user WHERE comment_postingan.postingan_id=:post_id');
          $this->db->bind('post_id', $data);
          $this->db->execute();
          return $this->db->getAll();
     }
     public function insert($post, $comment){
          $this->db->query('INSERT INTO comment_postingan (postingan_id, usercomment_id, comment)
                            VALUES (:pi,:ci,:c)');
          $this->db->bind('pi', $post);
          $this->db->bind('ci', $_SESSION['id']);
          $this->db->bind('c', $comment);
          $this->db->execute();
     }

}

?>