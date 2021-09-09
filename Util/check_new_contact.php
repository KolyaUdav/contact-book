<?php

require_once 'Handlers/ContactDataHandler.php';

if (isset($_POST['firstname'])) {
    if (empty($_POST['firstname'])) {
        echo '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                    Firstname field is empty
              </div>';
        return;
    }

    if (empty($_POST['lastname'])) {
        echo '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                    Lastname field is empty
              </div>';
        return;
    }

    if (empty($_POST['phone_number'])) {
        echo '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                    Phone Number field is empty
              </div>';
        return;
    }

    $handler = new ContactDataHandler(
        array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'phoneNumber' => $_POST['phone_number'],
            'email' => $_POST['email'],
            )
    );

    $resultArr = $handler->validateContact();

    if (array_key_exists('message', $resultArr)) {
        echo $resultArr['message'];
    } else {
        $handler->createNewContact($resultArr);
        print '<<div class="alert alert-success alert-tip" id="liveAlertPlaceholder" role="alert">New Contact was created!</div>';
    }
}