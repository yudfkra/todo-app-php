<?php

$heading = 'Index';

$config = config();
$db = new Database($config['database'], 'root', '');

$posts = $db->query("select * from posts order by created_at desc")->get();

view("posts/index.view.php", compact('heading', 'posts'));