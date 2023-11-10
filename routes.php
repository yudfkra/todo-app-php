<?php

/**
 * @var \Core\Router $router
 */

$router->get('/', 'tasks/index.php');

$router->post('/tasks/create', 'tasks/create.php')->only(['auth', 'verify.csrf']);
$router->get('/tasks/create', 'tasks/create.php')->only('auth');

$router->put('/task/edit', 'tasks/edit.php')->only(['auth', 'verify.csrf']);
$router->get('/task/edit', 'tasks/edit.php')->only('auth');

$router->delete('/task', 'tasks/delete.php')->only(['auth', 'verify.csrf']);
$router->get('/task', 'tasks/show.php');

$router->get('/tasks', 'tasks/index.php');

$router->post('/login', 'auth.php')->only(['guest', 'verify.csrf']);
$router->get('/login', 'auth.php')->only('guest');

$router->delete('/logout', 'logout.php')->only(['auth', 'verify.csrf']);

$router->get('/api/tasks', 'api/tasks/index.php')->only('auth.api');
$router->post('/api/tasks', 'api/tasks/create.php')->only('auth.api');

$router->put('/api/task', 'api/tasks/update.php')->only('auth.api');
$router->post('/api/task-image', 'api/tasks/update-image.php')->only('auth.api');
$router->delete('/api/task', 'api/tasks/delete.php')->only('auth.api');
$router->get('/api/task', 'api/tasks/show.php')->only('auth.api');