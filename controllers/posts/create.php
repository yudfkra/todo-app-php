<?php

use Core\{
    App,
    Database,
    Validator
};

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Validator::string($_POST['title'], 1, 256)) {
        $errors['title'] = "Isian 'title' harus diisi dengan maksimal 256 karakter.";
    }

    if (!Validator::string($_POST['content'], 1, 1000)) {
        $errors['content'] = "Isian 'content' harus diisi dengan maksimal 1000 karakter.";
    }

    if (empty($errors)) {
        /**
         * @var \Core\Database $db
         */
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO POSTS (user_id, title, content, created_at, updated_at) VALUES (:user_id, :title, :content, :created_at, :updated_at)', [
            ':user_id' => 1,
            ':title' => $_POST['title'] ?? null,
            ':content' => $_POST['content'] ?? null,
            ':created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            ':updated_at' => null,
        ]);

        header('location: /posts');
        exit();
    }
}

$heading = "Create Post";

view("posts/create.view.php", compact("heading", "errors"));


// $currentUserID = 2;