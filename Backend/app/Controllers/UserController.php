<?php 

require_once 'Controller.php';
require_once '../Backend/app/Model/Postingan.php';

class UserController extends Controller{
    
    public function index(){
        if(!preg_match('/^[a-zA-Z0-9]+$/', $_SESSION['id'])){
            header('Location:'.$_SERVER['HTTP_REFERER']);
            exit();
        }
        $model = new Postingan;
        $data = $model->customWhere("SELECT id_postingan,
                                            user_id,
                                            like_postingan.userlike_id,
                                            gambar,
                                            caption,
                                            users.username,
                                            postingan.created_at
                                            FROM postingan 
                                     JOIN users ON users.id_user=postingan.user_id
                                     LEFT OUTER JOIN like_postingan ON like_postingan.postingan_id=postingan.id_postingan AND like_postingan.userlike_id={$_SESSION['id']}
                                     WHERE user_id={$_SESSION['id']}
                                     ORDER BY id_postingan DESC");

        return Controller::view('profil/index',[
            'title' => 'Profil Saya',
            'css'   => 'profil',
            'post'  => $data
        ]);
    }

}



?>