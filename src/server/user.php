<?php
 if (isset($_COOKIE['token'])) {
     if (check_token($_COOKIE['token'], $pdo)) {
         if ($method === "GET" && !isset($formData)) {
             $user = get_user_by_id($formData['id'], $pdo);
             dumper($user);
         }

         if ($method === "POST") {
             add_user($formData, $pdo);
         }

         if ($method === "PUT"){
             update_user($formData['id'], $formData, $pdo);
             echo " u'r update user with id ".$formData['id'];
         }

         if ($method === "DELETE"){
             delete_user($formData['id'], $pdo);
             echo " u'r delete user with id ".$formData['id'];
         }
     } else {
         echo 'wrong token';
     }
 } else echo 'unauthorized';
