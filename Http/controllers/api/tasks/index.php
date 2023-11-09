<?php

use Core\App;
use Core\Database;
use Core\Responses\Json;

/** @var \Core\Database $db */
$db = App::resolve(Database::class);

$tasks = $db->query("select * from tasks order by created_at desc")->get();

return Json::data(['tasks' => $tasks])->output();