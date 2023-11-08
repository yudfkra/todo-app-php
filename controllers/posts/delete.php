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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? null) === 'DELETE') {
    $db->query("delete from posts where id = :id", [':id' => $id]);
}

header('location: /posts');
exit();