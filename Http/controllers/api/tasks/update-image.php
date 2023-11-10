<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Responses\Json;
use Core\Validator;
use Http\Forms\PostForm;

/** @var \Core\Authenticator $auth */
$auth = App::resolve(Authenticator::class);

$json = file_get_contents('php://input');
$data = $json ? json_decode($json, JSON_OBJECT_AS_ARRAY) : [];

$currentUserID = $auth->user('id');

$id = $_GET['id'] ?? null;
if (!Validator::integer($id)) {
    return Json::validation(['errors' => ['id' => 'Invalid Input']])->output();
}

/** @var \Core\Database $db */
$db = App::resolve(Database::class);

$task = $db->query("select * from tasks where id = :id", [':id' => $id])->findOrFail();

authorize($task['user_id'] === $currentUserID);

$form = PostForm::validate($task);

$form->uploadFile();

$db->query('UPDATE TASKS SET file = :file, updated_at = :updated_at WHERE id = :id', [
    ':id' => $id,
    ':file' => $form->attribute('image'),
    ':updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
]);

return Json::data(['task' => $task['id']])->output();