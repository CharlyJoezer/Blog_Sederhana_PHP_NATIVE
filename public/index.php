<?php 
session_start();
require_once '../Backend/Routes/web.php';

use Backend\Routes\web;

$uri = $_SERVER['REQUEST_URI'];
$methodHTTP = $_SERVER['REQUEST_METHOD'];

$parseurl = parse_url($uri);

if(!isset($parseurl['query'])){
    $parseurl['query'] = '';
}

$obj = new Web($parseurl['path'], $methodHTTP, $parseurl['query']);


?>