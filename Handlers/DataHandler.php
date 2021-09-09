<?php

require_once 'Validators/Validator.php';
require_once 'Validators/PasswordValidator.php';
require_once 'Crypt/Scrambler.php';
require_once 'Database/DB.php';

class DataHandler
{
    use PasswordValidator, Validator, Scrambler, DB {bindValues as private; connect as protected;}

    private $conn;

    public function __construct() {
        $this->conn = $this->connect();
    }

    public function getConnect(): PDO {
        return $this->conn;
    }

    protected function enter(int $id, string $firstname) {
        $this->setDataToSession($id, $firstname);
        $this->setTokenToCookie($id);
        header('Location: http://localhost/ContactBook/index.php');
    }

    private function setDataToSession(int $id, string $firstname) {
        session_start();

        $_SESSION['auth'] = true;
        $_SESSION['user_id'] = $id;
        $_SESSION['firstname'] = $firstname;
    }

    private function setTokenToCookie(int $id) {
        $tokenQuery = 'SELECT remember_token FROM users WHERE id = :id';
        $rememberToken = $this->getDataFromDB($this->conn, $tokenQuery, array('id' => $id))[0]['remember_token'];

        $token = Scrambler::hashCookieToken($rememberToken.time());

        $tempTokenQuery = 'UPDATE users SET temp_token = :temp_token WHERE id = :id';
        $this->sendDataToDB($this->conn, $tempTokenQuery, array('temp_token' => $token, 'id' => $id));

        setcookie('token', $token, time() + 60 * 60 * 24 * 30);
    }

}