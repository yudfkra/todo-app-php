<?php

use Core\{
    Database, Validator
};

$config = require base_path('config.php');
$db = new Database($config['database'], 'root', '');

$currentUserID = 2;

$id = $_GET['id'] ?? null;
if (!Validator::integer($id)) {
    abort(404, "Invalid Post ID");
}

$post = $db->query("select * from posts where id = :id", [':id' => $id])->findOrFail();

authorize($post['user_id'] === $currentUserID);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_REQUEST['delete'] ?? false) {
        $db->query("delete from posts where id = :id", [':id' => $id]);
        header('location: /posts');
        exit();
    }
}

$heading = "{$post['title']} - Post";

view("posts/show.view.php", compact("heading", "post"));