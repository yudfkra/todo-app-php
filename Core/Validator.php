<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF) : bool 
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;

        // return strlen(trim($value)) >= $min;
    }

    public static function integer($value)
    {
        return filter_var($value, FILTER_VALIDATE_INT);
    }
}