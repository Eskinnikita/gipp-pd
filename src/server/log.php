<?php
if (isset($_COOKIE['token'])) {
    if (check_token($_COOKIE['token'], $pdo)) {
        if ($method === "GET" && isset($formData['id'])) {
            $log = get_log_by_id($formData['id'], $pdo);
            if (isset($log['message'])){
                echo $log['message'];
            } else {
                echo json_encode($log, JSON_UNESCAPED_UNICODE);
            }
        } elseif ($method === "GET" && !isset($formData['id'])){
            $log = get_logs($pdo);
            if (isset($log['message'])){
                echo $log['message'];
            } else {
                echo json_encode($log, JSON_UNESCAPED_UNICODE);
            }
        }

         else sendResponse($method, $formData, '', 400, "Bad request", $pdo);
    } else {
        sendResponse($method, $formData, '', 400, "Wrong token", $pdo);
    }
} else sendResponse($method, $formData, '', 401, "Unauthorized", $pdo);
