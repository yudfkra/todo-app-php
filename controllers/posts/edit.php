<?php

use Core\{
    App,
    Database,
    Router,
    Validator
};


$currentUserID = 1;

$id = $_GET['id'] ?? null;
if (!Validator::integer($id)) {
    Router::abort(404, "Invalid Post ID");
}

/**
 * @var \Core\Database $db
 */
$db = App::resolve(Database::class);

$post = $db->query("select * from posts where id = :id", [':id' => $id])->findOrFail();

authorize($post['user_id'] === $currentUserID);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? null) === 'PATCH') {
    if (!Validator::string($_POST['title'], 1, 256)) {
        $errors['title'] = "Isian 'title' harus diisi dengan maksimal 256 karakter.";
    }

    if (!Validator::string($_POST['content'], 1, 1000)) {
        $errors['content'] = "Isian 'content' harus diisi dengan maksimal 1000 karakter.";
    }

    if (empty($errors)) {
        $db->query('UPDATE POSTS SET title = :title, content = :content, updated_at = :updated_at WHERE id = :id', [
            ':id' => $id,
            ':title' => $_POST['title'] ?? $post['title'] ?? null,
            ':content' => $_POST['content'] ?? $post['content'] ?? null,
            ':updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]);

        header('location: /post?id=' . $post['id']);
        exit();
    }
}

$heading = "{$post['title']} - Edit Post";

view("posts/edit.view.php", compact("heading", "post", "errors"));