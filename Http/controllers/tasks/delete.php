<?php

use Core\{
    App,
    Database,
    Router,
    Session,
    Validator
};

$currentUserID = Session::get('user')['id'] ?? null;

$id = $_GET['id'] ?? null;
if (!Validator::integer($id)) {
    Router::abort(404, "Invalid Task ID");
}

/**
 * @var \Core\Database $db
 */
$db = App::resolve(Database::class);

$task = $db->query("select * from tasks where id = :id", [':id' => $id])->findOrFail();

authorize($task['user_id'] === $currentUserID);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? null) === 'DELETE') {
    $db->query("delete from tasks where id = :id", [':id' => $id]);
}

redirect('/tasks');