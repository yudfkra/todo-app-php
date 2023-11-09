<?php

namespace Core\Contracts;

interface FormValidate
{
    public function valid(): bool;
    
    public function failed(): bool;
    
    public function errors(): array;

    public function error($field, $message);
    
    public function attributes(): array;

    public function attribute($field, $default = null);
}