<?php

use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$heading = 'Login';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validator = new LoginForm();
    $validator->validate($_POST);

    if (!$validator->isValid()) {
        $errors = $validator->errors();
    }

    if ($validator->isValid()) {
        /**
         * @var \Core\Database $db
         */
        $db = App::resolve(Database::class);

        $user = $db->query('select * from users where username = :username', [':username' => $_POST['username']])->find();
        if (!$user) {
            $errors['username'] = 'Username atau password salah.';
        }

        if ($user) {
            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                ];

                session_regenerate_id(true);

                header('location: /');
                exit();
            }

            $errors['username'] = 'Username atau password anda salah.';
        }
    }
}

view("login.view.php", compact("heading", "errors"));