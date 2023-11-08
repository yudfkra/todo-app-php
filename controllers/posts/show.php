<?php

use Core\{
    Database, Validator
};

$heading = "Post";

$config = require base_path('config.php');
$db = new Database($config['database'], 'root', '');

$currentUserID = 1;

$id = $_GET['id'] ?? null;
if (!Validator::integer($id)) {
    abort(404, "Invalid Post ID");
}

$post = $db->query("select * from posts where id = :id", [':id' => $id])->findOrFail();

authorize($post['user_id'] === $currentUserID);

$heading = "{$post['title']} - Post";

view("posts/show.view.php", compact("heading", "post"));