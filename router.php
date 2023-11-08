<?php

$configuredRoutes = require "routes.php"; 

function abort($code = 404, $message = "Page not Found.")
{
    http_response_code($code);

    $errorView = "{$code}.view.php";
    if (!file_exists($errorView)) {
        $errorView = "404.view.php";
    }
    
    view($errorView);
    exit();
}

function routeToController($uri, $routes = [])
{
    $controller = $routes[$uri] ?? null;
    if ($controller) {
        require $controller;
        exit();
    }

    abort(404, "Route not Found.");
}

$urlComponents = parse_url($_SERVER['REQUEST_URI']);

$uri = $urlComponents['path'];

routeToController($uri, $configuredRoutes);