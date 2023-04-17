<?php 
require_once '../Backend/Database/Connection.php';

class Postingan{
    protected $db;
    
    public function __construct()
    {
        $this->db = new Connection;
    }

    public function customWhere($query){
        $this->db->query($query);
        $this->db->execute();
        return $this->db->getAll();
    }
    
    public function getAll(){
        if(isset($_SESSION['login'])){
            $this->db->query("SELECT id_user,id_postingan,gambar,caption,username,postingan.created_at,like_postingan.id_like FROM postingan 
                              JOIN users ON postingan.user_id = users.id_user
                              LEFT OUTER JOIN like_postingan ON postingan.id_postingan=like_postingan.postingan_id AND ".$_SESSION['id']."=like_postingan.userlike_id
                              ORDER BY id_postingan DESC");
        }else{
            $this->db->query("SELECT id_user,id_postingan,gambar,caption,username,postingan.created_at FROM postingan 
                              JOIN users ON postingan.user_id = users.id_user ORDER BY id_postingan DESC");
        }
        $getData = $this->db->getAll();
        return $getData;
    }

    public function where($condition){
        $string = '';
        for($i = 0; $i < 3; $i++){
            $string .= $condition[$i];
        }
        $this->db->query("SELECT * FROM postingan WHERE ".$string);
        $this->db->execute();
        return $this->db->getAll();
    }


    public function create($data){
        $query = "INSERT INTO postingan (gambar, caption, user_id) VALUES(:gambar, :caption, :user_id)";
        $this->db->query($query);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('caption', $data['caption']);
        $this->db->bind('user_id', $data['user_id']);

        $this->db->execute();
    }

    public function delete($data){
        $query = "DELETE FROM postingan WHERE {$data[0]} $data[1] :find";
        $this->db->query($query);
        $this->db->bind('find', $data[2]);
        $this->db->execute();
    }

    public function checkStatusLike($data){
        $this->db->query("SELECT * FROM like_postingan WHERE userlike_id=:userlike AND postingan_id=:postingan_id");
        $this->db->bind('postingan_id', $data['id_postingan']);
        $this->db->bind('userlike', $_SESSION['id']);
        $this->db->execute();
        return $this->db->single();
    }

    public function likePost($data){
        $this->db->query("INSERT INTO like_postingan (postingan_id ,userlike_id)
        VALUES (:postingan_id, :userlike);");
        $this->db->bind('postingan_id', $data['id_postingan']);
        $this->db->bind('userlike', $_SESSION['id']);
        $this->db->execute();
    }

    public function unlikePost($data){
        $this->db->query("DELETE FROM like_postingan WHERE userlike_id=:userlike AND postingan_id=:postingan_id");
        $this->db->bind('postingan_id', $data['id_postingan']);
        $this->db->bind('userlike', $_SESSION['id']);
        $this->db->execute();
    }

    public function getDetailPostingan($id_post){
        $this->db->query("SELECT id_postingan,
                                user_id,
                                like_postingan.userlike_id,
                                gambar,
                                caption,
                                users.username,
                                postingan.created_at
                                FROM postingan 
                        JOIN users ON users.id_user=postingan.user_id
                        LEFT OUTER JOIN like_postingan ON like_postingan.postingan_id=postingan.id_postingan AND like_postingan.userlike_id={$_SESSION['id']}
                        WHERE id_postingan=:id_post");
        $this->db->bind('id_post', $id_post);
        $this->db->execute();
        return $this->db->single();
    }

    public function getUserPostingan($id){
        $this->db->query("SELECT id_postingan,user_id,gambar FROM postingan WHERE user_id=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->getAll();
    }
}


?>