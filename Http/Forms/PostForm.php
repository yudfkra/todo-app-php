<?php

namespace Http\Forms;

use Core\Validator;

class PostForm extends Form
{
    protected function handleValidate()
    {
        if (!Validator::string($this->attribute('title', ''), 1, 256)) {
            $this->error('title', "Isian 'title' harus diisi dengan maksimal 256 karakter.");
        }

        if (!Validator::string($this->attribute('content', ''), 1, 1000)) {
            $this->error('content', "Isian 'content' harus diisi dengan maksimal 1000 karakter.");
        }
    }
}
