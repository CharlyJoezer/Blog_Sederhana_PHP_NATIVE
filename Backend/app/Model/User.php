<?php 

require_once '../Backend/Database/Connection.php';


class User{
    protected $db;
    public function __construct()
    {
        $this->db = new Connection;
    }
    public function getAll(){
        $this->db->query("SELECT * FROM users");
        $getData = $this->db->getAll();
        return $getData;
    }
    public function create($data){
        $data['role'] = "1";
        $query = "INSERT INTO users (username, password) VALUES(:username, :password)";
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $data['password']);

        $this->db->execute();
    }
    public function get($data){
        $this->db->query('SELECT * FROM users WHERE username = :usr AND password = :pws');
        $this->db->bind('usr', $data['username']);
        $this->db->bind('pws', $data['password']);
        $getData = $this->db->single();
        return $getData;
    }

    public function getUser($id){
        $this->db->query("SELECT id_user,username,role,foto_profil,created_at FROM users WHERE id_user=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->single();
    }
}

?>