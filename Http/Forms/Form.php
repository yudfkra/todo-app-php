<?php

namespace Http\Forms;

use Core\Contracts\FormValidate;
use Core\Exceptions\FormValidationException;

abstract class Form implements FormValidate
{
    protected array $errors = [];

    public function __construct(
        protected array $attributes = []
    ) {
        $this->handleValidate();
    }

    public function valid(): bool
    {
        return !$this->failed();
    }

    public function failed(): bool
    {
        return count($this->errors()) >= 1;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }

    public function attributes(): array
    {
        return $this->attributes;
    }

    public function attribute($field, $default = null)
    {
        return $this->attributes[$field] ?? $default;
    }

    public function throw()
    {
        FormValidationException::throw($this);
    }

    abstract protected function handleValidate();

    public static function validate($attributes = [])
    {
        $instance = new static($attributes);

        if ($instance->failed()) {
            $instance->throw();
        }

        return $instance;
    }
}
