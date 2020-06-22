<?php
 if (isset($_COOKIE['token'])) {
     if (check_token($_COOKIE['token'], $pdo)) {
         if ($method === "GET" && isset($formData['id'])) {
             $user = get_user_by_id($formData['id'], $pdo);
             dumper($user);
         }

         elseif ($method === "POST") {
             add_user($formData, $pdo);
         }

         elseif ($method === "PUT"){
             update_user($_GET['id'], $formData, $pdo);
             echo " u'r update user with id ".$_GET['id'];
         }

         elseif ($method === "DELETE"){
             delete_user($_GET['id'], $pdo);
             echo " u'r delete user with id ".$_GET['id'];
         } else echo 'bad request';
     } else {
         echo 'wrong token';
     }
 } else echo 'unauthorized';
