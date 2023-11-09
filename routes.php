<?php

/**
 * @var \Core\Router $router
 */

$router->get('/', 'posts/index.php');

$router->post('/posts/create', 'posts/create.php')->only(['auth', 'verify.csrf']);
$router->get('/posts/create', 'posts/create.php')->only('auth');

$router->patch('/post/edit', 'posts/edit.php')->only(['auth', 'verify.csrf']);
$router->get('/post/edit', 'posts/edit.php')->only('auth');

$router->delete('/post', 'posts/delete.php')->only(['auth', 'verify.csrf']);
$router->get('/post', 'posts/show.php');

$router->get('/posts', 'posts/index.php');

$router->post('/login', 'auth.php')->only(['guest', 'verify.csrf']);
$router->get('/login', 'auth.php')->only('guest');

$router->delete('/logout', 'logout.php')->only(['auth', 'verify.csrf']);

$router->get('/api/posts', 'api/posts/index.php')->only('auth.api');
$router->get('/api/post', 'api/posts/show.php')->only('auth.api');