<?php

namespace Lib;
// Clase con metodos para sanetizar y validar los campos de los formularios
class Validar {

    public static function sanitizeString(string $input): string {
        return strip_tags(trim($input));
    }

    public static function sanitizeEmail(string $email): string {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    public static function sanitizePhone(string $phone): string {
        return preg_replace('/[^0-9+\-\(\) ]/', '', $phone);
    }

    public static function sanitizeInt($input): int {
        return (int) preg_replace('/[^0-9-]/', '', $input);
    }

    public static function sanitizeDouble($input): float {
        $cleaned = preg_replace('/[^0-9\.-]/', '', str_replace(',', '.', $input));
        return (float) $cleaned;
    }

    public static function sanitizeDate(string $date): string {
        return preg_replace('/[^0-9\-]/', '', $date);
    }

    public static function validateString(string $input): bool {
        return !empty($input) && is_string($input);
    }

    public static function validateEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePhone(string $phone): bool {
        return preg_match('/^[0-9]{9}$/', $phone);
    }

    public static function validateDate(string $date): bool {
        $dateArray = explode('-', $date);
        return count($dateArray) === 3 && checkdate((int) $dateArray[1], (int) $dateArray[2], (int) $dateArray[0]);
    }

    public static function validateInt($input): bool {
        return filter_var($input, FILTER_VALIDATE_INT) !== false;
    }

    public static function validateDouble($input): bool {
        return filter_var($input, FILTER_VALIDATE_FLOAT) !== false;
    }

}

?>
