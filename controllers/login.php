<?php

use Core\App;
use Core\Database;
use Core\Validator;

$heading = 'Login';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Validator::string($_POST['username'])) {
        $errors['username'] = "Isian 'username' harus diisi.";
    }

    if (!Validator::string($_POST['password'], 5, 255)) {
        $errors['password'] = "Isian 'password' harus diisi dan lebih dari 5 karakter.";
    }

    if (empty($errors)) {
        /**
         * @var \Core\Database $db
         */
        $db = App::resolve(Database::class);

        $user = $db->query('select * from users where username = :username', [':username' => $_POST['username']])->find();
        if (!$user) {
            $errors['username'] = 'Username atau password salah.';
        }

        if ($user) {
            $validPassword = password_verify($_POST['password'], $user['password']);
            if (!$validPassword) {
                $errors['username'] = 'Username atau password anda salah.';
            }

            // valid password, do auth
            if ($validPassword) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                ];

                header('location: /');
                exit();
            }
        }
    }
}

view("login.view.php", compact("heading", "errors"));