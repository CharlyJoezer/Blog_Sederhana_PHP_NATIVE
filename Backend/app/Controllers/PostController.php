<?php 

require_once 'Controller.php';
require_once '../Backend/app/Model/Postingan.php';

class PostController extends Controller{
    public function createPost(){
        if(!isset($_FILES['image'])){
            $_SESSION['message']['fail'] = 'Gambar tidak boleh kosong!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if($_FILES['image']['name'] == ''){
            $_SESSION['message']['fail'] = 'Gambar tidak ditemukan!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if(isset($_POST['caption'])){
            $caption = $_POST['caption'];
        }else{
            $caption = '';
        }


        $getImageExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if(
            $getImageExtension != 'jpg' &&
            $getImageExtension != 'jpeg' && 
            $getImageExtension != 'gif' &&
            $getImageExtension != 'png'
            ){
                $_SESSION['message']['fail'] = 'Format gambar harus JPG, JPEG, PNG, GIF!';
                header('Location: ' . $_SERVER['HTTP_REFERER']); 
                exit();
        }

        $imageName = hash("sha512", $_FILES['image']['name'] . str_replace(['-',':'], '', date("Y-m-d H:i:s")));
        $imageName .= '.'.$getImageExtension;
        move_uploaded_file($_FILES['image']['tmp_name'], "../Backend/Storage/image/{$imageName}");

        $finaldata = [
            'gambar' => $imageName,
            'caption' => $caption,
            'user_id' => $_SESSION['id'] ,
        ];

        $model = new Postingan();
        $model->create($finaldata);
        $_SESSION['message']['success'] = 'Post Berhasil diposting!';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    public function getImage(){
        header("Content-Type: image/jpeg");
        $gambar_data = file_get_contents("../Backend/Storage/image/".$_GET['image']);
        echo $gambar_data;
    }

    public function deletePost(){
        if(!isset($_GET['delete'])){
            header('HTTP/1.1 404 Not Found');
            exit();
        }
        if(!preg_match('/^[a-zA-Z0-9]+$/', $_GET['delete']) || $_GET['delete'] == ''){
            header('HTTP/1.1 404 Not Found');
            exit();
        }
        $model = new Postingan();
        $checkData = $model->customWhere("SELECT * FROM postingan WHERE id_postingan=".$_GET['delete'])[0];
        if(count($checkData) <= 0){
            header('HTTP/1.1 404 Not Found');
            exit();
        }   
        
        $pathimage = "../Backend/Storage/image/".$checkData['gambar'];
        unlink($pathimage);


        $model->delete(['id_postingan', '=', $_GET['delete']]);
        header('Location: /profil');
        exit();
    }

    public function likePostingan(){
        if(!isset($_POST['status']) || !is_string($_POST['status']) || !ctype_alpha($_POST['status'])){
            http_response_code(403);
            echo json_encode(['message' => 'Payload status is not valid',
                              'code' => 403,
                              'status' => false
                            ]);
        exit();
        }   
        if(!isset($_POST['id_postingan'])){
            http_response_code(403);
            echo json_encode(['message' => 'Payload id_postingan is not valid',
                              'code' => 403,
                              'status' => false
                             ]);
            exit();
        }
        if(!isset($_SESSION['login'])){
            http_response_code(401);
            echo json_encode(['message' => 'Auth required',
                              'code' => 401,
                              'status' => false
                             ]);
            exit();
        }

    
        $model = new Postingan();
        try{
            $checkStatus = $model->checkStatusLike($_POST);
        }catch(Exception){
            http_response_code(500);
            echo json_encode(['message' => 'Server is not responding!',
                              'code' => 404,
                              'status' => false,
                              'where' => 'Like Post'
                             ]);
            exit();
        }

        if($checkStatus == false && $_POST['status'] == 'false'){
            try{
                $model->likePost($_POST);
            }catch(Exception){
                http_response_code(500);
                echo json_encode(['message' => 'Server is not responding!',
                                  'code' => 404,
                                  'status' => false,
                                  'where' => 'Like Post'
                                 ]);
                exit();
            }
        }elseif(isset($checkStatus) && $_POST['status'] == 'true'){
            try{
                $model->unlikePost($_POST);
            }catch(Exception){
                http_response_code(500);
                echo json_encode(['message' => 'Server is not responding!',
                                  'code' => 404,
                                  'status' => false,
                                  'where' => 'Like Post'
                                 ]);
                exit();
            }
        }else{
            http_response_code(404);
            echo json_encode(['message' => 'Terjadi Kesalahan!',
                              'code' => 404,
                              'status' => false
                             ]);
            exit();
        }

        
        http_response_code(200);
        echo json_encode(['message' => 'Request success!',
                          'code' => 200,
                          'status' => true
                         ]);
        exit();
    }

    public function detailPostingan(){
        if(!isset($_GET['post'])){
            header('HTTP/1.1 404 Not Found');
            exit();
        }
        if(!is_numeric($_GET['post'])){
            header('HTTP/1.1 404 Not Found');
            exit();
        }
        $id_post = $_GET['post'];
        $model = new Postingan;
        try{
            $data = $model->getDetailPostingan($id_post);
        }catch(Exception){
            http_response_code(500);
            header('HTTP/1.1 500 SERVER ERROR');
            exit();
        }

        return Controller::view('profil/detail_post',[
            'title' => "@{$data['username']} {$data['caption']} | Postingan",
            'css'   => 'detail_post',
            'post'  => $data
        ]);
    }
}



?>