<?php 
require_once '../Backend/Database/Connection.php';

class Postingan {
    protected $db;

    public function __construct()
    {
        $this->db = new Connection;
    }

    public function getAll(){
        $this->db->query("SELECT id_user,id_postingan,gambar,caption,username FROM postingan JOIN users ON postingan.user_id = users.id_user ORDER BY id_postingan DESC");
        $getData = $this->db->getAll();
        return $getData;
    }

    public function create($data){
        $query = "INSERT INTO postingan (gambar, caption, user_id) VALUES(:gambar, :caption, :user_id)";
        $this->db->query($query);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('caption', $data['caption']);
        $this->db->bind('user_id', $data['user_id']);

        $this->db->execute();
    }
}


?>