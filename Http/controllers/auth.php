<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = LoginForm::validate([
        'username' => $_POST['username'] ?? '',
        'password' => $_POST['password'] ?? '',
    ]);

    $validLogin = (new Authenticator)->attemptLogin($form->attribute('username'), $form->attribute('password'));
    if (!$validLogin) {
        $form->error('username', 'Username atau Password anda salah')
            ->throw();
    }

    return redirect();
}

$heading = 'Login';
$errors = Session::get('errors', []);

return view("login.view.php", compact("heading", "errors"));