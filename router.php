<?php

$urlComponents = parse_url($_SERVER['REQUEST_URI']);

$uri = $urlComponents['path'];

$configuredRoutes = [
    '/' => 'controllers/index.php',
    '/post' => 'controllers/post.php',
    '/login' => 'controllers/login.php',
    '/logout' => 'controllers/logout.php',
];

function abort($code = 404, $message = "Page not Found.")
{
    http_response_code($code);

    require "views/{$code}.view.php";
    exit();
}

function routeToController($uri, $routes = [])
{
    $controller = $routes[$uri] ?? null;
    if ($controller) {
        require $controller;
        exit();
    }

    abort();
}

routeToController($uri, $configuredRoutes);