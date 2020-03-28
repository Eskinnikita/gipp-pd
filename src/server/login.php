<?php


if (isset($_POST['login']) && isset($_POST['pass']) && !isset($_COOKIE['token'])) {

    check_login($_POST['login'], $_POST['pass'], $pdo);

} else {echo 'no data';}