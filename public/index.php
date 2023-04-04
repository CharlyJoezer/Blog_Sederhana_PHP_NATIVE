<?php 
session_start();
require_once '../Backend/Routes/web.php';

use Backend\Routes\web;

$uri = $_SERVER['REQUEST_URI'];
$methodHTTP = $_SERVER['REQUEST_METHOD'];

// $getRoute = str_replace('/crud/public', '', $uri);

// die();

$obj = new Web($uri, $methodHTTP);



?>