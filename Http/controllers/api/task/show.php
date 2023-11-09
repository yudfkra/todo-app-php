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

$post = $db->query("select * from posts where id = :id", [':id' => $id])->findOrFail();

return Json::data(['post' => $post])->output();