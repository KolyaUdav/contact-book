<?php

session_start();

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $_SESSION['csrf_token']) {
    return;
}

if (isset($_POST['login'])) {
    if (empty(trim($_POST['login']))) {
        echo '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                    Your login field is empty
              </div>';
        return;
    }

    if (empty(trim($_POST['password']))) {
        echo '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                    Your password field is empty
              </div>';
        return;
    }

    $handler = new LoginDataHandler(
        $_POST['login'],
        $_POST['password']
    );

    $messageKey = 'message';
    $resultArr = $handler->validateLoginData();

    if (array_key_exists($messageKey, $resultArr)) {
        echo $resultArr[$messageKey];
    } else {
        $handler->login($resultArr);
    }
}