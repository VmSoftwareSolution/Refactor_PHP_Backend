<?php
require_once __DIR__ . '/../Error/CustomException.php';
$messages = require_once __DIR__ . '/Message.php';


    function validateEmail(string $email): void {
        global $messages; 

        if (trim($email) === '') {
            throw new EmailRequiredException($messages['email_required']);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailFormatException($messages['email_invalid_format']);
        }
    }

    function validatePassword(string $password): void {
        global $messages;

        if (trim($password) === '') {
            throw new PasswordRequiredException($messages['password_required']);
        }

        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/';

        if (!preg_match($regex, $password)) {
            throw new WeakPasswordException($messages['password_weak']);
        }
    }

    function IsNotEmpty(string $value, string $field): void {
        global $messages;

        if (trim($value) === '') {
            throw new EmptyFieldException(
                str_replace(
                    ':field', $field,
                    $messages['field_empty'])
            );
        }
    }

    function IsNotNegativeNumber(int $value, string $field): void {
        global $messages;

        if ($value < 0) {
            throw new NegativeValueException(
                str_replace(
                    ':field', $field, 
                    $messages['field_negative'])
            );
        }
    }

    function ValidateId(int $id): void {
        global $messages;

        if ($id <= 0) {
            throw new InvalidIdException($messages['id_invalid']);
        }
    }

    function ValidateParamPagination(int $offset, int $limit): void {
        global $messages;

        if ($offset < 0) {
            throw new InvalidParameterException($messages['invalid_parameter']);
        }

        if ($limit <= 0) {
            throw new InvalidParameterException($messages['invalid_parameter']);
        }
    }

    function ValidatePrice(int $price): void {
        global $messages;

        if ($price <= 0) {
            throw new InvalidPriceException($messages['price_invalid']);
        }
    }