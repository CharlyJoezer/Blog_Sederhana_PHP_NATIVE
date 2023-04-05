<?php 
require_once '../Backend/Database/Connection.php';

class Postingan {
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
        $this->db->query("SELECT id_user,id_postingan,gambar,caption,username,postingan.created_at FROM postingan JOIN users ON postingan.user_id = users.id_user ORDER BY id_postingan DESC");
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
}


?>