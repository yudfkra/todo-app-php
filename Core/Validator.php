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
}