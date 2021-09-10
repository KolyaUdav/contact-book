<?php

session_start();

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $_SESSION['csrf_token']) {
    return;
}

if (isset($_POST['login'])) {
    if (empty($_POST['login'])) {
        echo '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                    Your login field is empty
              </div>';
        return;
    }

    if (empty($_POST['password'])) {
        echo '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                    Your password field is empty
             </div>';
        return;
    }

    if (empty($_POST['repeat_password'])) {
        echo '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                    Your repeat password field is empty.</div>';
        return;
    }

    if (empty($_POST['firstname'])) {
        echo '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                    Your firstname field is empty.</div>';
        return;
    }

    if (empty($_POST['lastname'])) {
        echo '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                    Your lastname field is empty.</div>';
        return;
    }

    $handler = new RegisterDataHandler(
        $_POST['login'],
        $_POST['password'],
        $_POST['repeat_password'],
        $_POST['firstname'],
        $_POST['lastname']
    );

    $messageKey = 'message';
    $resultArr = $handler->validateRegistrationData();

    if (array_key_exists($messageKey, $resultArr)) {
        echo $resultArr[$messageKey];
    } else {
        $handler->register($resultArr);
    }
}