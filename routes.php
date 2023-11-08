<?php

/**
 * @var \Core\Router $router
 */

$router->get('/', 'controllers/posts/index.php');

$router->post('/posts/create', 'controllers/posts/create.php');
$router->get('/posts/create', 'controllers/posts/create.php');

$router->patch('/post/edit', 'controllers/posts/edit.php');
$router->get('/post/edit', 'controllers/posts/edit.php');

$router->delete('/post', 'controllers/posts/delete.php');
$router->get('/post', 'controllers/posts/show.php');


$router->get('/posts', 'controllers/posts/index.php');

$router->post('/login', 'controllers/login.php');
$router->get('/login', 'controllers/login.php');
// $router->get('/logout', 'controllers/logout.php');