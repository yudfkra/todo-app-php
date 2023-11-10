<?php

namespace Core;

class Validator
{
    public function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function string($value, $min = 1, $max = INF) : bool 
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function integer($value)
    {
        return filter_var($value, FILTER_VALIDATE_INT);
    }

    public static function in($value, array $array)
    {
        return $value && (in_array($value, $array) || (bool) ($array[$value] ?? false));
    }

    public static function file($field)
    {
        $file = $_FILES[$field] ?? null;

        if ($file && $file["error"] === UPLOAD_ERR_OK) {
            return true;
        }

        return false;
    }

    public static function fileSize($field, $min = 1024, $max = 1048576)
    {
        $file = $_FILES[$field] ?? null;
        
        if ($file) {
            return $file['size'] >= $min && $file['size'] <= $max;
        }

        return false;
    }

    public static function fileExtension($field, array $extensions)
    {
        $file = $_FILES[$field] ?? null;

        if ($file) {
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

            return in_array($fileExtension, $extensions);
        }

        return false;
    }
}