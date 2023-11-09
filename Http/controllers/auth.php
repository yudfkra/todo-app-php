<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = new LoginForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($form->validate($_POST)) {
        if ((new Authenticator)->attempt($_POST['username'], $_POST['password'])) {
            return redirect();
        }

        $form->error('username', 'Username atau password anda salah.');
    }

    $_SESSION['_flash']['errors'] = $form->errors();
    return redirect('/login');
}

$heading = 'Login';
$errors = $_SESSION['_flash']['errors'] ?? [];

return view("login.view.php", compact("heading", "errors"));