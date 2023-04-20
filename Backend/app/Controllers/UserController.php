<?php 

require_once 'Controller.php';
require_once '../Backend/app/Model/Postingan.php';
require_once '../Backend/app/Model/User.php';
require_once '../Backend/app/Model/Pengikut.php';

class UserController extends Controller{
    
    public function index(){
        if(!preg_match('/^[a-zA-Z0-9]+$/', $_SESSION['id'])){
            header('Location:'.$_SERVER['HTTP_REFERER']);
            exit();
        }
        $user = new User();
        $getUser = $user->getUser($_SESSION['id']);
        
        $postingan = new postingan();
        $getPost = $postingan->getUserPostingan($_SESSION['id']);

        return Controller::view('profil/index',[
            'title' => 'Profil Saya',
            'css'   => 'profil',
            'post'  => $getPost,
            'user'  => $getUser
        ]);
    }

    public function viewProfilUser(){
        if(!isset($_GET['id'])){
            header('HTTP/1.1 404 Not Found');
            exit();
        }
        if(!is_numeric($_GET['id'])){
            header('HTTP/1.1 404 Not Found');
            exit();
        }

        $user = new User();
        $getUser = $user->getUser($_GET['id']);
        
        $postingan = new postingan();
        $getPost = $postingan->getUserPostingan($_GET['id']);

        return Controller::view('profil/detail_user',[
            'title' => "@{$getUser['username']} | Postingan",
            'css'   => 'profil',
            'user'  => $getUser,
            'post'  => $getPost
        ]);
    }

    public function apiFollow(){
        if(!isset($_POST['id'])){
            http_response_code(404);
            echo json_encode(['message' => "Data Not valid",
                'code' => 404,
                'status' => false
                            ]);
                exit();
        }
        if(!is_numeric($_POST['id'])){
            http_response_code(404);
            echo json_encode(['message' => "Data Not valid",
                'code' => 404,
                'status' => false
                            ]);
                exit();
        }
        if($_POST['id'] === $_SESSION['id']){
            http_response_code(404);
            echo json_encode(['message' => "You can't follow your own",
                'code' => 404,
                'status' => false
                            ]);
                exit();
        }

        $model = new User;
        $pengikut = new Pengikut;
        if(isset($_SESSION['id'])){
            try{
                $checkTwoUser = $model->getTwoUser($_POST['id'], $_SESSION['id']);
            }catch(Exception){
                http_response_code(500);
                echo json_encode(['message' => 'Server Error',
                    'code' => 500,
                    'status' => false
                                ]);
                    exit();
            }
            if(count($checkTwoUser) == 2){
                $checkAlreadyFollow = $pengikut->getFollowing($_SESSION['id'], $_POST['id']);
                if($checkAlreadyFollow == false){
                    try{
                        $pengikut->insertFollowing($_SESSION['id'], $_POST['id']);
                    }catch(Exception){
                        http_response_code(500);
                        echo json_encode(['message' => 'Server Error',
                            'code' => 500,
                            'status' => false
                                        ]);
                            exit();
                    }
                    http_response_code(200);
                    echo json_encode(['message' => 'Success',
                        'code' => 200,
                        'status' => true
                                    ]);
                        exit();
                }else{
                    try{
                        $pengikut->deleteFollowing($_SESSION['id'], $_POST['id']);
                    }catch(Exception){
                        http_response_code(500);
                        echo json_encode(['message' => 'Server Error',
                            'code' => 500,
                            'status' => false
                                        ]);
                            exit();
                    }
                    http_response_code(200);
                    echo json_encode(['message' => 'You Already Following this user!',
                    'code' => 200,
                    'status' => false
                                ]);
                    exit();
                }
            }else{
                http_response_code(401);
                echo json_encode(['message' => 'Login required',
                'code' => 401,
                'status' => false
                            ]);
                exit();
            }
        }else{
            http_response_code(401);
            echo json_encode(['message' => 'Login required',
                              'code' => 401,
                              'status' => false
                            ]);
            exit();
        }
    }
    public function updateUser(){
        $id = $_SESSION['id'];
        $image = null;
        $username = null;

        if(isset($_FILES['image']['name'])){
            if($_FILES['image']['name'] != ''){
                if($_FILES['image']['tmp_name'] == '' || $_FILES['image']['type'] != 'image/jpeg'){
                    $_SESSION['message']['fail'] = 'File tidak sesuai!';
                    header('Location: ' . $_SERVER['HTTP_REFERER']); 
                    exit();
                }
                $getImageExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                if(
                    $getImageExtension != 'jpg' &&
                    $getImageExtension != 'jpeg' &&
                    $getImageExtension != 'png'
                    ){
                        $_SESSION['message']['fail'] = 'Format gambar harus JPG, JPEG, PNG, GIF!';
                        header('Location: ' . $_SERVER['HTTP_REFERER']); 
                        exit();
                }
                $image_path = '../Backend/Storage/Profil_Image/';
                if (is_file($image_path . $_SESSION['image']) && is_writable($image_path . $_SESSION['image'])) {
                    // Delete the file
                    unlink($image_path.$_SESSION['image']);
                }
                $imageName = hash("sha512", $_FILES['image']['name'] . str_replace(['-',':'], '', date("Y-m-d H:i:s")));
                $imageName .= '.'.$getImageExtension;
                move_uploaded_file($_FILES['image']['tmp_name'], "../Backend/Storage/Profil_Image/{$imageName}");
                $image = $imageName;
            }
        }


        if(isset($_POST['username'])){
            if(!preg_match('/^[a-zA-Z0-9]', $_POST['username'])){
                $username = $_POST['username']; 
            }else{
                $_SESSION['message']['fail'] = 'Username hanya boleh mengandung Angka dan Huruf!';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }else{
            $_SESSION['message']['fail'] = 'Username tidak boleh kosong!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        if(str_replace(' ', '', $username) == ''){
            $_SESSION['message']['fail'] = 'Username tidak boleh kosong!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $finalData = [
            'username' => $username,
            'image'    => $image,
            'id'       => $id
        ];
        $model = new User;
        $model->updateUser($finalData);
        
        $_SESSION['message']['success'] = 'Berhasil diubah!';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    public function getImage(){
        header("Content-Type: image/jpeg");
        $gambar_data = file_get_contents("../Backend/Storage/Profil_Image/".$_GET['image']);
        echo $gambar_data;
    }

}



?>