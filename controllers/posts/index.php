<?php

use Core\App;
use Core\Database;

$heading = 'Index';

/**
 * @var \Core\Database $db
 */
$db = App::resolve(Database::class);

$posts = $db->query("select * from posts order by created_at desc")->get();

view("posts/index.view.php", compact('heading', 'posts'));