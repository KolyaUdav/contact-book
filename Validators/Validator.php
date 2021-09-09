<?php

trait Validator
{

    public static function validate(array $dataToValidate): array {
        $cleanedData = array();

        while ($data = current($dataToValidate)) {
            $key = key($dataToValidate);
            $cleanedData[$key] = htmlspecialchars(stripslashes(trim($data)));
            next($dataToValidate);
        }

        return $cleanedData;
    }

}