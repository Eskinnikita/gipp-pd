<?php
   if (check_token($_COOKIE['token'], $pdo)){
       if ($method ==="GET" && !isset($formData)){
            $user = get_user($formData['id'], $pdo);
    }

    if ($method === "POST"){
        add_user($formData, $pdo);
    }
   } else {
       echo 'wrong token';
   }
