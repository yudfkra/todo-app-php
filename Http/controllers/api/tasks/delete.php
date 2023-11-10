<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Responses\Json;
use Core\Validator;
use Http\Forms\PostForm;

/** @var \Core\Authenticator $auth */
$auth = App::resolve(Authenticator::class);

$currentUserID = $auth->user('id');

$id = $_GET['id'] ?? null;
if (!Validator::integer($id)) {
    return Json::validation(['errors' => ['id' => 'Invalid Input']])->output();
}

/** @var \Core\Database $db */
$db = App::resolve(Database::class);

$task = $db->query("select * from tasks where id = :id", [':id' => $id])->findOrFail();

authorize($task['user_id'] === $currentUserID);

$db->query("delete from tasks where id = :id", [':id' => $id]);

return Json::data(null)->output();