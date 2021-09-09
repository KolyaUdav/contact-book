<?php

session_start();

setcookie('token', '');
session_destroy();

header('Location: http://localhost/ContactBook/login.php');
