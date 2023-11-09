<?php

namespace Http\Forms;

use Core\Validator;
use Http\Forms\Form;

class LoginForm extends Form
{
    public function validate($data = [])
    {
        if (!Validator::string($data['username'])) {
            $this->errors['username'] = "Isian 'username' harus diisi.";
        }

        if (!Validator::string($data['password'], 5, 255)) {
            $this->errors['password'] = "Isian 'password' harus diisi dan lebih dari 5 karakter.";
        }

        return $this->isValid();
    }
}
