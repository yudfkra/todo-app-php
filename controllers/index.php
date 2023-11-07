<?php

$heading = 'Index';

$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

$posts = $db->query("select * from posts order by created_at desc")->fetchAll();

require "views/index.view.php";