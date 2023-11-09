<?php

use Core\{
    App,
    Database,
    Validator
};
use Core\Responses\Json;

$id = $_GET['id'] ?? null;
if (!Validator::integer($id)) {
    return Json::validation(['errors' => ['id' => 'Invalid Input']])->output();
}

/** @var \Core\Database $db */
$db = App::resolve(Database::class);

$task = $db->query("select * from tasks where id = :id", [':id' => $id])->findOrFail();

return Json::data(['task' => $task])->output();