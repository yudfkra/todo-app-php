<?php

use Core\Session;

session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . "Core/functions.php";

spl_autoload_register(function ($class) {
    $class = str_replace(['\\'], [DIRECTORY_SEPARATOR], $class);
    require base_path("{$class}.php");
});

require base_path("bootstrap.php");

$router = new \Core\Router();

$configuredRoutes = require base_path("routes.php"); 

$urlComponents = parse_url($_SERVER['REQUEST_URI']);
$uri = $urlComponents['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (\Core\Exceptions\FormValidationException $e) {
    Session::flash('errors', $e->form()->errors());
    Session::flash('old', $e->form()->attributes());
    //throw $th;

    return redirect($router->previousURL());
}

\Core\Session::unflash();