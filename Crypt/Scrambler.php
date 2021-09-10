<?php

trait Scrambler
{

    public static function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function hashPrimaryToken(string $firstname, string $lastname, string $login): string {
        return password_hash($firstname.$lastname.$login, PASSWORD_BCRYPT);
    }

    public static function hashCookieToken(string $rememberToken): string {
        return password_hash($rememberToken, PASSWORD_BCRYPT);
    }

    public static function generateCsrfToken(): string {
        $token = substr(str_shuffle('qazwsxedcrfvtgbyhnujmikolpQAZWSXEDCRFVTGBYHNUJMIKOLP'), 0, 10);
        return $_SESSION['csrf_token'] = $token;
    }

}