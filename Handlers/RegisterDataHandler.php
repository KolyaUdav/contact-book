<?php

require_once 'DataHandler.php';

class RegisterDataHandler extends DataHandler
{
    /**
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $repeatPassword;
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;

    public function __construct(string $login, string $password, string $repeatPassword,
                                string $firstname, string $lastname) {
        parent::__construct();

        $this->login = $login;
        $this->password = $password;
        $this->repeatPassword = $repeatPassword;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function validateRegistrationData(): array {
        if (!parent::checkEqualPasswords($this->password, $this->repeatPassword)) {
            return array('message' => '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                                            Please, repeat your password correctly.
                                       </div>');
        }

        if (!parent::checkLengthPassword($this->password)) {
            return array('message' => '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                                            Your password must be 8 chars minimum.
                                       </div>');
        }

        $data = array(
            'login' => $this->login,
            'password' => $this->password,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
        );

        $cleanedData = parent::validate($data);

        if (parent::checkLoginExisting(parent::getConnect(), $cleanedData['login'])) {
            return array('message' => '<div class="alert alert-danger alert-tip" id="liveAlertPlaceholder" role="alert">
                                            This Login already exists.
                                       </div>');
        }

        return $cleanedData;
    }

    public function register(array $cleanedData): void {
        $rememberToken = Scrambler::hashPrimaryToken(
            $cleanedData['firstname'],
            $cleanedData['lastname'],
            $cleanedData['login']
        );

        $this->password = Scrambler::hashPassword($cleanedData['password']);

        $query = 'INSERT INTO users 
                SET
                    login = :login, password = :password, 
                    remember_token = :remember_token, firstname = :firstname, lastname = :lastname';

        $bindParams = array(
            'login' => $cleanedData['login'],
            'password' => $this->password,
            'remember_token' => $rememberToken,
            'firstname' => $cleanedData['firstname'],
            'lastname' => $cleanedData['lastname'],
        );

        if (parent::sendDataToDB(parent::getConnect(), $query, $bindParams)) {
            $query = 'SELECT id FROM users WHERE login = :login';
            $id = parent::getDataFromDB(parent::getConnect(), $query, array('login' => $cleanedData['login']))[0]['id'];
            parent::enter($id, $cleanedData['firstname']);
        }
    }

}