<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Responses\Json;
use Http\Forms\PostForm;

/** @var \Core\Authenticator $auth */
$auth = App::resolve(Authenticator::class);

$json = file_get_contents('php://input');
$data = $json ? json_decode($json, JSON_OBJECT_AS_ARRAY) : [];

$form = PostForm::validate([
    'title' => $data['title'] ?? '',
    'content' => $data['content'] ?? '',
    'status' => $data['status'] ?? '',
]);

/**  @var \Core\Database $db */
$db = App::resolve(Database::class);

$db->query('INSERT INTO TASKS (user_id, title, content, status, created_at, updated_at) VALUES (:user_id, :title, :content, :status, :created_at, :updated_at)', [
    ':user_id' => $auth->user('id'),
    ':title' => $form->attribute('title'),
    ':content' => $form->attribute('content'),
    ':status' => $form->attribute('status'),
    ':created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
    ':updated_at' => null,
]);

$taskID = $db->lastInsertID();

$task = $db->query("select * from tasks where id = :id", [':id' => $taskID])->find();

return Json::data(['task' => $task])->statusCode(201)->output();