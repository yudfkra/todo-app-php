<?php

/**
 * @var \Core\Router $router
 */

$router->get('/', 'posts/index.php');

$router->post('/posts/create', 'posts/create.php')->only('auth');
$router->get('/posts/create', 'posts/create.php')->only('auth');

$router->patch('/post/edit', 'posts/edit.php')->only('auth');
$router->get('/post/edit', 'posts/edit.php')->only('auth');

$router->delete('/post', 'posts/delete.php')->only('auth');
$router->get('/post', 'posts/show.php');

$router->get('/posts', 'posts/index.php');

$router->post('/login', 'auth.php')->only('guest');
$router->get('/login', 'auth.php')->only('guest');

$router->delete('/logout', 'logout.php')->only('auth');