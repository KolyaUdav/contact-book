<?php

require_once 'Handlers/ContactDataHandler.php';

if (isset($_POST['contact_id']) && !empty($_POST['contact_id'])) {
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        $handler = new ContactDataHandler(
            array(
                'user_id' => $_SESSION['user_id'],
                'contact_id' => $_POST['contact_id'],
            )
        );

        $cleanedData = $handler->validateContact();

        if (array_key_exists('message', $cleanedData)) {
            echo $cleanedData['message'];
        } else {
            $handler->addChosenContact($cleanedData);
            print '<<div class="alert alert-success alert-tip" id="liveAlertPlaceholder" role="alert">
                        Contact was added to Chosen!
                   </div>';
        }
    }
}