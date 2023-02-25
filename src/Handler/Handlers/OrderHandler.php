<?php 

namespace ES\Handler\Handlers;

use ES\Validator\Validator;

trait OrderHandler
{
    static function handleOrder(?string $name, ?string $tel, ?string $email, ?string $address, ?string $comment)
    {
        $errors = [];

        if (empty(trim($name)))
        {
            $errors['name'] = "Введите поле ФИО";
        }
        else 
        {
            if (!Validator::isValidName($name))
                $errors['name'] = 'Некорректное значение ФИО';
        }

        if (empty(trim($tel)))
        {
            $errors['numberPhone'] = "Введите поле Телефон";
        }
        else 
        {
            if (!Validator::isValidNumberPhone($tel))
                $errors['numberPhone'] = 'Некорректное значение Телефона';
        }

        if (empty(trim($email)))
        {
            $errors['email'] = 'Введите поле Email';
        }
        else
        {
            if (!Validator::isValidEmail($email))
                $errors['email'] = 'Некорректное значение Email';
        }

        if (empty(trim($address)))
        {
            $errors['address'] = 'Введите поле Адресс';
        }

        return $errors;
    }
}