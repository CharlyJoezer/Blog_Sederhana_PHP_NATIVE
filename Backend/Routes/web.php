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
                            if($_SESSION['login'] == false){
                                header('Location: login');
                            }
                            $this->Route('HomeController', 'index');
                        break;
                    
                        case '/login':
                            if(isset($_SESSION['login'])){
                                header('Location: / ');
                            }
                            $this->Route('AuthController', 'index');
                        break;
                    
                        case '/logout':
                            $this->Route('AuthController', 'logout');
                        break;
                            
                        case '/register':
                            $this->Route('AuthController', 'viewRegister');
                        break;
                            
                        case '/postingan/image':
                            $this->Route('PostController', 'getImage');
                        break;
                        
                        case '/profil':
                            $this->Route('UserController', 'index');
                        break;
                            
                        case '/postingan/delete':
                            $this->Route('PostController', 'deletePost');
                        break;

                        default:
                        header('HTTP/1.1 404 Not Found');
                        exit();
                    }
                break;
    
                case 'POST':
                    switch ($uri){
                        case '/auth/login':
                            $this->Route('AuthController', 'authLogin');
                        break;
                        
                        case '/auth/register':
                            $this->Route('AuthController', 'authRegister');
                        break;
                        
                        case '/create/postingan':
                            $this->Route('PostController', 'createPost');
                        break;
    
                        default:
                        header('HTTP/1.1 404 Not Found');
                        exit();
                    }
                break;
    
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
            }
        }else{
            header('HTTP/1.1 404 Not Found');
        }
    }

    // public function guest(){
    //     if(isset($_SESSION['login'])){
    //         if($_SESSION['login'] == true){
    //             header('Location: /crud/public/');
    //         }
    //     }
    // }
    // public function auth(){
    //     if(isset($_SESSION['login'])){
    //         if($_SESSION['login'] == false){
    //             header('Location: /crud/public/login');
    //         }
    //     }
    //     header('Location: /crud/public/login');
    // }
}

?>