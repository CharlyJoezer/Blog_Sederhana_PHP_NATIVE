<?php 

require_once 'Controller.php';
require_once '../Backend/app/Model/User.php';

class AuthController extends Controller{
    public function index(){
        return Controller::view('Auth/login',[
            'title' => 'Sign In',
            'css' => 'login'
        ]);
    }

    public function authLogin(){
        $username = (String)$_POST['username'];
        $password = (String)$_POST['password'];
        if($username != '' && $password != ''){
            if(preg_match('/^[a-zA-Z0-9]+$/', $username) )
            {
                $_POST['password'] = hash("sha512", $_POST['password']); 
                $model = new User;
                $getUser = $model->get($_POST);
                if($getUser != false){
                    $_SESSION["login"] = true;
                    $_SESSION["id"] = $getUser['id_user'];
                    $_SESSION["username"] = $username;
                    $_SESSION['message']['success'] = 'Welcome';
                    header('Location: /');
                    exit();
                }else{
                    $_SESSION['message']['fail'] = 'Username atau Password salah!';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            }else{
                $_SESSION['message']['fail'] = 'Username atau Password salah!';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();    
            }
        }else{
            $_SESSION['message']['fail'] = 'Username atau Password salah!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function viewRegister(){
        return Controller::view('Auth/register',[
            'title' => 'Register',
            'css' => 'register'
        ]);
    }
    public function authRegister(){
        $username = (String)$_POST['username'];
        $password = (String)$_POST['password'];
        if($username != '' && $password != ''){
            if(preg_match('/^[a-zA-Z0-9]+$/', $username)){
                $_POST['password'] = hash("sha512", $_POST['password']); 
                $model = new User;
                $model->create($_POST);
                $_SESSION['message']['success'] = 'Silahkan Login';
                header('Location: ' . '/login');
                exit();
            }else{
                $_SESSION['message']['fail'] = 'Username tidak diperbolehkan!';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();    
            }
        }else{
            $_SESSION['message']['fail'] = 'Username atau Password tidak boleh kosong!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        header('Location: login');
        exit;
    }
}

?>