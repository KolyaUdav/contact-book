<?php

require_once 'DataHandler.php';

class LoginDataHandler extends DataHandler
{

    private $login;
    private $password;

    public function __construct(string $login, string $password) {
        parent::__construct();
        $this->login = $login;
        $this->password = $password;
    }

    public function validateLoginData(): array {
        $cleanedData = parent::validate(array('login' => $this->login, 'password' => $this->password));

        if (!parent::checkLoginExisting(parent::getConnect(), $cleanedData['login'])) {
            return array('message' => '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                                            This login does not register yet.
                                       </div>');
        }

        return $cleanedData;
    }

    public function login($cleanedData) {
        $query = 'SELECT * FROM users WHERE login = :login';
        $row = parent::getDataFromDB(parent::getConnect(), $query, array('login' => $cleanedData['login']));
        $row = $row[0];

        if (password_verify($cleanedData['password'], $row['password'])) {
            parent::enter($row['id'], $row['firstname']);
        } else {
            print '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">Wrong Password!</div>';
        }
    }

}