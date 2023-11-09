<?php

namespace Http\Forms;

use Core\Validator;
use Http\Forms\Form;

class LoginForm extends Form
{
    protected function handleValidate()
    {
        if (!Validator::string($this->attribute('username', ''))) {
            $this->error('username', "Isian 'username' harus diisi.");
        }

        if (!Validator::string($this->attribute('password', ''), 5, 255)) {
            $this->error('password', "Isian 'password' harus diisi dan lebih dari 5 karakter.");
        }
    }
}
