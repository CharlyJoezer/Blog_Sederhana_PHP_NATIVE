<?php 
require_once 'Controller.php';
require_once '../Backend/app/Model/Postingan.php';


class HomeController extends Controller{

    public function index(){
        $model = new Postingan();
        $data = $model->getAll();
        // var_dump($data);
        // die();
        return Controller::view('Home/index', [
            'title' => 'Home',
            'css' => 'home',
            'post' => $data
        ]);
    }
}


?>