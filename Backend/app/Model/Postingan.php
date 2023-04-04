<?php 
require_once '../Backend/Database/Connection.php';

class Postingan {
    protected $db;

    public function __construct()
    {
        $this->db = new Connection;
    }

    public function getAll(){
        $this->db->query("SELECT id_user,id_postingan,gambar,caption,username FROM postingan JOIN users ON postingan.user_id = users.id_user");
        $getData = $this->db->getAll();
        return $getData;
    }

    public function create($data){
        $query = "INSERT INTO postingan (gambar, caption, id_user) VALUES(:gambar, :caption, :id_user)";
        $this->db->query($query);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('caption', $data['caption']);
        $this->db->bind('id_user', $data['id_user']);

        $this->db->execute();
    }
}


?>