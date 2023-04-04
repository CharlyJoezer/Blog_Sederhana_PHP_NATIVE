<?php 
require_once 'Controller.php';

class HomeController extends Controller{

    public function index(){
        return Controller::view('Home/index', [
            'title' => 'Home',
            'nama' => 'Charly Joezer',
            'css' => 'home'
        ]);
    }
}


?>