<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



header('Content-Type: application/json, multipart/form-data; charset=utf-8');
include_once 'function.php';
include_once 'connect.php';
include_once 'dumper.php';

$method = $_SERVER['REQUEST_METHOD'];
$formData = getFormData($method);

function getFormData($method) {
    if ($method === 'GET') return $_GET;
    if ($method === 'POST') return $_POST;

    $data = array();
    $exploded = explode('&', file_get_contents('php://input'));

    foreach ($exploded as $pair) {
        $item = explode('=', $pair);
        if (count($item) == 2) {
            $data[urldecode($item[0])] = urldecode($item[1]);
        }
    }

    return $data;
}

$uri = $_SERVER['REQUEST_URI'];
$uri = rtrim($uri, '/');

$uri = str_replace($_SERVER['QUERY_STRING'], '', $uri);

$uri = explode('/', $uri);
$router = $uri[1];
$router = str_replace('?', '', $router);

switch ($router){
    case 'logout':
        logout($_COOKIE['token'], $pdo);
        echo "u'r unlogined";
        break;
    case 'login':
        require_once 'login.php';
        break;
    case 'user':
        require_once 'user.php';
        break;
    case 'news';
        require_once 'news.php';
        break;
    default:
        $message = array("message"=>"unknown route");
        sendResponse($method, $formData, "", 404, $message, $pdo);
}