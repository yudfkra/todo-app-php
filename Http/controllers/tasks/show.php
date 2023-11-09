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

$heading = "{$task['title']} - Task";

view("tasks/show.view.php", compact("heading", "task"));