<?php
    function validate_user($userData){
        foreach ($userData as $key=>$value){
            switch ($key){
                case 'fName':
                case 'lName':
                case 'mName':
                    $i = strlen($value);
                    while ($i--) {
                        if (is_numeric($value[$i])) return 'Wrong '.$key;
                    }
                    break;
                case 'email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)){
                        return 'Wrong email';
                    }
                    break;
                case 'pass':
                    if (strlen($value)<8){
                        return 'Weak password';
                    }
                    break;
            }
        }
        return true;
    }

