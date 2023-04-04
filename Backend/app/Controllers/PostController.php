<?php 

require_once 'Controller.php';
require_once '../Backend/app/Model/Postingan.php';

class PostController extends Controller{
    public function createPost(){
        if(!isset($_FILES['image']) && !isset($_POST['caption'])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if($_FILES['image']['name'] == '' && preg_match('/^[a-zA-Z0-9]+$/', $_POST['caption']) ){
            header('Location: ' . $_SERVER['HTTP_REFERER']); 
            exit();
        }
        // MAKE RANDOM STRING FOR FILE NAME
        $imageName = hash("sha512", $_FILES['image']['name'] . str_replace(['-',':'], '', date("Y-m-d H:i:s")));
        $imageName .= '.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['image']['tmp_name'], "../Backend/Storage/image/{$imageName}");

        $finaldata = [
            'gambar' => $imageName,
            'caption' => $_POST['caption'],
            'user_id' => $_SESSION['id'] ,
        ];

        $model = new Postingan();
        $model->create($finaldata);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    public function getImage(){
        header("Content-Type: image/jpeg");
        $gambar_data = file_get_contents("../Backend/Storage/image/".$_GET['image']);
        echo $gambar_data;
        
    }
}



?>