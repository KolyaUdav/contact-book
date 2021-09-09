<?php

trait PasswordValidator
{
    public static function checkEqualPasswords(string $password, string $repeatPassword): bool {
        if ($password !== $repeatPassword) {
            return false;
        }

        return true;
    }

    public static function checkLengthPassword(string $password): bool {
        if (strlen($password) < MIN_PASSWORD_LENGTH) {
            return false;
        }

        return true;
    }
}