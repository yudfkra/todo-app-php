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

$heading = "{$post['title']} - Post";

view("posts/show.view.php", compact("heading", "post"));