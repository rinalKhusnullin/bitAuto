<?php 

namespace ES\Validator;

class Validator
{
    static function isValidNumberPhone(string $numberPhone) : bool
    {
        return preg_match("#^7[0-9]{10}$#", $numberPhone);
    }

    static function isValidEmail(string $email) : bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}