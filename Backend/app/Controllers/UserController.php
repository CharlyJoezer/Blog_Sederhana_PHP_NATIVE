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
        $model = new Postingan;
        $data = $model->customWhere("SELECT id_postingan,
                                            user_id,
                                            gambar
                                            FROM postingan 
                                     WHERE user_id={$_SESSION['id']}
                                     ORDER BY id_postingan DESC");

        return Controller::view('profil/index',[
            'title' => 'Profil Saya',
            'css'   => 'profil',
            'post'  => $data
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
                        $pengikut->deleteFollowing($checkTwoUser);
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

}



?>