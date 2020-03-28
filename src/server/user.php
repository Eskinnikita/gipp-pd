<?php
   if (check_token($_COOKIE['token'], $pdo)){
       if ($method ==="GET" && !isset($formData)){
//        get_user();
    }

    if ($method === "POST"){

        add_user($formData, $pdo);
    }
   } else {
       echo 'wrong token';
   }
