<?php
function sendResponse ($method, $requestData, $result, $httpCode, $message, $pdo){
    switch ($httpCode){
        case 400:
            header ('HTTP/1.0 400 Bad Request');
            $result = array('error'=>$message);
            break;
        case 404:
            header ('HTTP/1.0 404 Not Found');
            $result = array('error'=> $message);
            break;
        case 401:
            header('HTTP/1.0 401 Unauthorized');
            $result = array('error' => $message);
            break;
    }
    add_log($method, $result, $requestData, $httpCode, $pdo);
    echo json_encode(array($result, JSON_UNESCAPED_UNICODE));
}