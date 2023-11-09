<?php

use Core\App;
use Core\Database;
use Core\Responses\Json;

/** @var \Core\Database $db */
$db = App::resolve(Database::class);

$posts = $db->query("select * from posts order by created_at desc")->get();

return Json::data(['posts' => $posts])->output();