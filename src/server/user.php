<?php
 if (isset($_COOKIE['token'])) {
     if (check_token($_COOKIE['token'], $pdo)) {
         if ($method === "GET" && isset($formData['id'])) {
             $user = get_user_by_id($formData['id'], $pdo);
             if (isset($user['message'])){
                 sendResponse($method, $formData, '',404, $user['message'], $pdo);
             } else {
                 sendResponse($method, $formData, $user,200, '', $pdo);
             }
         }

         elseif ($method === "POST") {
             $user = add_user($formData, $pdo);
             if (isset($user['message'])){
                 sendResponse($method, $formData, '',404, $user['message'], $pdo);
             } else {
                 sendResponse($method, $formData, $user,200, '', $pdo);
             }
         }

         elseif ($method === "PUT"){
             $user = update_user($_GET['id'], $formData, $pdo);
             if (isset($user['message'])){
                 sendResponse($method, $formData, '',404, $user['message'], $pdo);
             } else {
                 sendResponse($method, $formData, $user,200, '', $pdo);
             }
         }

         elseif ($method === "DELETE"){
            $user = delete_user($_GET['id'], $pdo);
             if (isset($user['message'])){
                 sendResponse($method, $formData, '',404, $user['message'], $pdo);
             } else {
                 sendResponse($method, $formData, $user,200, '', $pdo);
             }
         } else sendResponse($method, $formData, '', 400, "Bad request", $pdo);
     } else {
         sendResponse($method, $formData, '', 400, "Wrong token", $pdo);
     }
 } else sendResponse($method, $formData, '', 401, "Unauthorized", $pdo);
