<?php

use Core\{
    Database, Router, Validator
};

$currentUserID = 1;

$id = $_GET['id'] ?? null;
if (!Validator::integer($id)) {
    Router::abort(404, "Invalid Post ID");
}

$config = require base_path('config.php');
$db = new Database($config['database'], 'root', '');

$post = $db->query("select * from posts where id = :id", [':id' => $id])->findOrFail();

authorize($post['user_id'] === $currentUserID);

$heading = "{$post['title']} - Post";

view("posts/show.view.php", compact("heading", "post"));