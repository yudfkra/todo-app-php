<?php

$heading = "Post";

$config = require base_path('config.php');
$db = new Database($config['database'], 'root', '');

$currentUserID = 1;

$paramID = $_GET['id'] ?? null;

$id = filter_var($paramID, FILTER_VALIDATE_INT);
if ($id === false) {
    abort(404, "Invalid Post ID");
}

$post = $db->query("select * from posts where id = :id", [':id' => $id])->findOrFail();

authorize($post['user_id'] === $currentUserID);

$heading = "{$post['title']} - Post";

view("posts/show.view.php", compact("heading", "post"));