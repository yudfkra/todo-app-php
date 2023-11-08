<?php

/**
 * @var \Core\Router $router
 */

$router->get('/', 'controllers/posts/index.php');

$router->post('/posts/create', 'controllers/posts/create.php')->only('auth');
$router->get('/posts/create', 'controllers/posts/create.php')->only('auth');

$router->patch('/post/edit', 'controllers/posts/edit.php')->only('auth');
$router->get('/post/edit', 'controllers/posts/edit.php')->only('auth');

$router->delete('/post', 'controllers/posts/delete.php')->only('auth');
$router->get('/post', 'controllers/posts/show.php');

$router->get('/posts', 'controllers/posts/index.php');

$router->post('/login', 'controllers/auth.php')->only('guest');
$router->get('/login', 'controllers/auth.php')->only('guest');

$router->delete('/logout', 'controllers/logout.php')->only('auth');