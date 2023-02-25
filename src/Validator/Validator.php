<?php 

namespace ES\Validator;

class Validator
{
    static function isValidName(string $fullName) : bool
    {
        return true; // нужно по хорошему регулярку сюда запилить для проверки валидного имени (без цифр и прочей чепухи)
    }

    static function isValidNumberPhone(string $numberPhone) : bool
    {
        return preg_match("#^(\+7|8)[0-9]{10}$#", $numberPhone);
    }

    static function isValidEmail(string $email) : bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}