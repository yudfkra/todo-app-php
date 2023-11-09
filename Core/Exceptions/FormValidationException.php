<?php

namespace Core\Exceptions;

use Core\Contracts\FormValidate;

class FormValidationException extends \Exception
{
    protected readonly FormValidate $form;

    public static function throw(FormValidate $form)
    {
        $instance = new static;

        $instance->form = $form;

        throw $instance;
    }

    public function form()
    {
        return $this->form;
    }
}
