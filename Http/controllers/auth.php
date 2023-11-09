<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = new LoginForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($form->validate($_POST)) {
        if ((new Authenticator)->attempt($_POST['username'], $_POST['password'])) {
            redirect();
        }

        $form->error('username', 'Username atau password anda salah.');
    }
}

$heading = 'Login';
$errors = $form->errors();

return view("login.view.php", compact("heading", "errors"));