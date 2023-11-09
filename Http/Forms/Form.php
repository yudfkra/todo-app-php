<?php

namespace Http\Forms;

use Http\Contracts\ValidateForm;

abstract class Form implements ValidateForm
{
    public array $errors = [];

    abstract public function validate($data = []);

    public function isValid()
    {
        return count($this->errors()) === 0;
    }

    public function errors()
    {
        return $this->errors;
    }
}
