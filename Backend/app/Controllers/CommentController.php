<?php 
require_once 'Controller.php';
require_once '../Backend/app/Model/Postingan.php';
require_once '../Backend/app/Model/Comment.php';


class CommentController extends Controller{

    public function getComment(){
        if(!isset($_POST['id'])){
          header('Content-Type: application/json', response_code:400);
          echo json_encode([
               'status' => false,
               'code' => 400,
               'message' => 'Bad Request: id required'     
          ]);
          exit();
        }
        $id = $_POST['id'];
        $model = new Comment;
        $data = $model->get($id);


        header('Content-Type: application/json', response_code:200);
        echo json_encode([
             'status' => true,
             'code' => 200,
             'message' => 'success',
             'data' => $data
        ]);
        exit();

    }
    
    public function createComment(){
       if(!isset($_POST['id'])){
          header('Content-Type: application/json', response_code:400);
          echo json_encode([
               'status' => false,
               'code' => 400,
               'message' => 'Bad Request: id required'     
          ]);
          exit();
        }
       if($_POST['id'] == ''){
          header('Content-Type: application/json', response_code:400);
          echo json_encode([
               'status' => false,
               'code' => 400,
               'message' => 'Bad Request: id required'     
          ]);
          exit();
        }
       if(!isset($_POST['comment'])){
          header('Content-Type: application/json', response_code:400);
          echo json_encode([
               'status' => false,
               'code' => 400,
               'message' => 'Bad Request: id required'     
          ]);
          exit();
        }
       if($_POST['comment'] == ''){
          header('Content-Type: application/json', response_code:400);
          echo json_encode([
               'status' => false,
               'code' => 400,
               'message' => 'Bad Request: id required'     
          ]);
          exit();
        }

        $id = $_POST['id'];
        $comment = $_POST['comment'];
        $model = new Comment;
        $model->insert($id, $comment);
        header('Content-Type: application/json', response_code:200);
        echo json_encode([
             'status' => true,
             'code' => 200,
             'message' => 'success',
        ]);
        exit();
    }
}
