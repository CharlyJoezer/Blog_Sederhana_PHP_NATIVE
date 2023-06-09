<?php 

namespace Backend\Routes;

use Exception;
use HomeController;

class Web{

    public function __construct($uri, $method, $query = ''){
            switch($method){
                case 'GET':
                    switch ($uri){
                        case '/':
                            $this->Route('HomeController', 'index');
                        break;
                    
                        case '/login':
                            if(isset($_SESSION['login'])){
                                header('Location: / ');
                                exit();
                            }
                            $this->Route('AuthController', 'index');
                        break;
                    
                        case '/logout':
                            if(!isset($_SESSION['login'])){
                                header('Location: / ');
                                exit();
                            }
                            $this->Route('AuthController', 'logout');
                        break;
                            
                        case '/register':
                            if(isset($_SESSION['login']) == true){
                                header('Location: /');
                                exit();
                            }
                            $this->Route('AuthController', 'viewRegister');
                        break;
                            
                        case '/postingan/image':
                            $this->Route('PostController', 'getImage');
                        break;
                        
                        case '/profil':
                            if($_SESSION['login'] == false){
                                header('Location: /login');
                                exit();
                            }
                            $this->Route('UserController', 'index');
                        break;
                            
                        case '/postingan/delete':
                            if($_SESSION['login'] == false){
                                header('Location: /login');
                                exit();
                            }
                            $this->Route('PostController', 'deletePost');
                        break;

                        case '/postingan/detail':
                            $this->Route('PostController', 'detailPostingan');
                        break;

                        case '/profil/user':
                            if($_SESSION['login'] == false){
                                header('Location: /login');
                                exit();
                            }
                            $this->Route('UserController', 'viewProfilUser');
                        break;

                        case '/profil/user/image':
                            $this->Route('UserController', 'getImage');
                        break;

                        default:
                        header('HTTP/1.1 404 Not Found');
                        exit();
                    }
                break;
    
                case 'POST':
                    switch ($uri){
                        case '/auth/login':
                            if($_SESSION['login'] == true){
                                header('Location: /');
                                exit();
                            }
                            $this->Route('AuthController', 'authLogin');
                        break;
                        
                        case '/auth/register':
                            if(isset($_SESSION['login'])){
                                header('Location: / ');
                                exit();
                            }
                            $this->Route('AuthController', 'authRegister');
                        break;
                        
                        case '/create/postingan':
                            if(!isset($_SESSION['login'])){
                                header("HTTP/1.1 403 Forbidden");
                                echo json_encode(['status' => false, 'code' => '403 Forbidden']);
                                exit();
                            }
                            $this->Route('PostController', 'createPost');
                        break;
                        case '/profil/edit':
                            if(!isset($_SESSION['login'])){
                                header("HTTP/1.1 401 Unauthorized");
                                echo json_encode(['status' => false, 'code' => '401 Unauthorized']);
                                exit();
                            }
                            $this->Route('UserController', 'updateUser');
                        break;


                        // API
                        case '/api/send/like-postingan':
                            if(!isset($_SESSION['login'])){
                                header("HTTP/1.1 401 Unauthorized");
                                echo json_encode(['status' => false, 'code' => '401 Unauthorized']);
                                exit();
                            }
                            $this->Route('PostController', 'likePostingan');
                        break;
                            
                        case '/api/follow':
                            if(!isset($_SESSION['login'])){
                                header("HTTP/1.1 401 Unauthorized");
                                echo json_encode(['status' => false, 'code' => '401 Unauthorized']);
                                exit();
                            }
                            $this->Route('UserController', 'apiFollow');
                        break;

                        case '/api/postingan/get-comment':
                            $this->Route('CommentController', 'getComment');
                        break;

                        case '/api/postingan/send-comment':
                            if(!isset($_SESSION['login'])){
                                header("HTTP/1.1 401 Unauthorized");
                                echo json_encode(['status' => false, 'code' => '401 Unauthorized']);
                                exit();
                            }
                            $this->Route('CommentController', 'createComment');
                        break;


                        default:
                        header('HTTP/1.1 404 Not Found');
                        exit();
                    }
                break;


                default:
                header('HTTP/1.1 404 Not Found');
                exit();
            }
    }


    public function Route($controller, $method){
        $getPath = "../Backend/app/Controllers/{$controller}.php";
        if(file_exists($getPath)){
            require_once $getPath;
            $object = new $controller();
            if(method_exists($object, $method)){
                $object->$method();
            }else{
            header('HTTP/1.1 404 Not Found');
            exit();
            }
        }else{
            header('HTTP/1.1 404 Not Found');
            exit();
        }
    }

    public function auth(){
        if(isset($_SESSION['login'])){
            header('Location: / ');
        }
    }
}

?>