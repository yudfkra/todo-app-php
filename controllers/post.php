<?php

$heading = "Post";

$config = require 'config.php';
$db = new Database($config['database'], 'root', '');

$paramID = $_GET['id'];

$id = filter_var($paramID, FILTER_VALIDATE_INT);
if (!$id) {
    abort(404, "Invalid Post ID");
}

$post = $db->query("select * from posts where id = :id", [':id' => $id])->fetch();
if (!$post) {
    abort(404, "Post '{$id}' not Found.");
}

require "views/post.view.php";