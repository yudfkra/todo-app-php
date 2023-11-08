<?php

$router->get('/', 'controllers/posts/index.php');

$router->get('/posts/create', 'controllers/posts/create.php');
$router->post('/posts/create', 'controllers/posts/create.php');

$router->delete('/post', 'controllers/posts/delete.php');
$router->get('/post', 'controllers/posts/show.php');

$router->get('/posts', 'controllers/posts/index.php');

// $router->get('/login', 'controllers/login.php');
// $router->get('/logout', 'controllers/logout.php');