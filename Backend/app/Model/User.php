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
        $this->db->query("SELECT id_user,
                                username,
                                foto_profil,
                                pengikut.id_pengikut as check_flw,
                                (SELECT COUNT(*) FROM pengikut WHERE diikuti_id=:id ) AS jm,
                                (SELECT COUNT(*) FROM pengikut WHERE mengikuti_id=:id ) AS jd
                        FROM users
                        LEFT OUTER JOIN pengikut ON pengikut.mengikuti_id={$_SESSION['id']} AND pengikut.diikuti_id=:id
                        WHERE id_user=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->single();
    }

    public function getTwoUser($id1, $id2){
        $this->db->query("SELECT id_user FROM users WHERE id_user=:id1 OR id_user=:id2");
        $this->db->bind('id1', $id1);
        $this->db->bind('id2', $id2);
        $this->db->execute();
        return $this->db->getAll();
    }

    public function updateUser($data){
        if($data['image'] == null){
            $this->db->query("UPDATE users SET username=:username WHERE id_user=:id");
            $this->db->bind('username', $data['username']);
        }else{
            $this->db->query("UPDATE users SET username=:username, foto_profil=:fp WHERE id_user=:id");
            $this->db->bind('username', $data['username']);
            $this->db->bind('fp', $data['image']);
            $_SESSION["image"] = $data['image'];
        }
        $_SESSION["username"] = $data['username'];
        $this->db->bind('id', $data['id']);
        $this->db->execute();
    }
}

?>