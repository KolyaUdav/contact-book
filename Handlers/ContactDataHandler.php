<?php

class ContactDataHandler extends DataHandler
{

    private $contactData;

    public function __construct($contactData)
    {
        parent::__construct();
        $this->contactData = $contactData;
    }

    public function validateContact(): array {
        return parent::validate($this->contactData);
    }

    public function createNewContact(array $cleanedContactData) {
        $query = 'INSERT INTO contacts SET firstname = :firstname, lastname = :lastname, phone_number = :phoneNumber';

        if (array_key_exists('email', $cleanedContactData)) {
            $query = $query.', email = :email';
        }
        try {
            parent::sendDataToDB(parent::getConnect(), $query, $cleanedContactData);
        } catch (Exception $e) {
            printf('<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">Error: %s.</div>', $e->getMessage());
        }
    }

    public function addChosenContact(array $cleanedContactData) {
        $query = 'INSERT INTO users_contacts SET user_id = :user_id, contact_id = :contact_id';

        try {
            parent::sendDataToDB(parent::getConnect(), $query, $cleanedContactData);
        } catch (Exception $e) {
            printf('<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">Error: %s.</div>', $e->getMessage());
        }
    }
}