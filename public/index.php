<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . "Core/functions.php";

spl_autoload_register(function ($class) {
    $class = str_replace(['\\'], [DIRECTORY_SEPARATOR], $class);
    require base_path("{$class}.php");
});

require base_path("bootstrap.php");

\Core\Session::initialize();

$router = new \Core\Router();

$configuredRoutes = require base_path("routes.php"); 

$urlComponents = parse_url($_SERVER['REQUEST_URI']);
$uri = $urlComponents['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (\Core\Exceptions\FormValidationException $e) {
    if (\Core\Router::isApiRequest()) {
        return \Core\Responses\Json::validation(['errors' => $e->form()->errors()])->output();
    }

    \Core\Session::flash('errors', $e->form()->errors());
    \Core\Session::flash('old', $e->form()->attributes());

    return redirect($router->previousURL());
}

\Core\Session::unflash();