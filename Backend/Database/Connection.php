<?php 

class Connection
{
    // Menentukan informasi koneksi database
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "php_native";
    private $port = "3308";

    private $db;
    private $stmt;

    public function __construct()
    {
        try {
            $conn = new PDO("mysql:host=$this->server;port=$this->port;dbname=$this->database", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $conn;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }

    }
    
    public function query($query){
        $this->stmt = $this->db->prepare($query);
    }
    public function execute(){
        $this->stmt->execute();
    }


    public function getAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function bind($param, $value, $type = null)
    {
        if( is_null($type)){
            switch(true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

}   

?>