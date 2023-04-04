<?php

class Controller{
    public static function view($view, $data = null){
       if(file_exists("../Backend/app/Views/{$view}.php")){
        if(isset($_SESSION['login'])){
            if($_SESSION['login'] == true){
                $auth = [
                    'username' => $_SESSION['username']
                ];
            }
        }

        return require_once "../Backend/app/Views/{$view}.php";
            
        }else{
            header('HTTP/1.1 404 View Not Found');
            exit();
        }
    }
}


?>