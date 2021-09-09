<?php

session_start();

if (isset($_SESSION['auth']) && !empty($_SESSION['auth'])) {
    if (isset($_COOKIE['token']) && !empty($_COOKIE['token'])) {
        $query = 'SELECT temp_token FROM users WHERE id = :id';
        $handler = new DataHandler();
        $token = $handler->getDataFromDB($handler->getConnect(), $query, array('id' => $_SESSION['user_id']))[0]['temp_token'];
        if ($_COOKIE['token'] !== $token) {
            setcookie('token', '');
            session_destroy();
            header('Location: http://localhost/ContactBook/login.php');
        }
    } else {
        header('Location: http://localhost/ContactBook/login.php');
    }
} else {
    header('Location: http://localhost/ContactBook/login.php');
}

