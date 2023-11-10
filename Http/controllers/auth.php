<?php

use Core\App;
use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = LoginForm::validate([
        'username' => $_POST['username'] ?? '',
        'password' => $_POST['password'] ?? '',
    ]);

    /** @var \Core\Authenticator $auth */
    $auth = App::resolve(Authenticator::class);

    $validLogin = $auth->attemptLogin($form->attribute('username'), $form->attribute('password'));
    if (!$validLogin) {
        $form->error('username', 'Username atau Password anda salah')
            ->throw();
    }

    return redirect();
}

$heading = 'Login';
$errors = Session::get('errors', []);

return view("login.view.php", compact("heading", "errors"));