<?php

use Core\App;
use Core\Database;

$heading = 'Index';

/**
 * @var \Core\Database $db
 */
$db = App::resolve(Database::class);

$tasks = $db->query("select * from tasks order by created_at desc")->get();

view("tasks/index.view.php", compact('heading', 'tasks'));