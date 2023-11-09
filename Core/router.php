<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;

class Router
{
    protected array $routes = [];

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
        ];

        return $this;
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
    }

    public function route($uri, $method = 'GET')
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                $controller = base_path("Http/controllers/{$route['controller']}");
                if (file_exists($controller)) {
                    return require $controller;
                }
            }
        }

        self::abort(404, "Route not Found.");
    }

    public static function abort($code = 404, $message = "Page not Found.")
    {
        http_response_code($code);

        $errorView = "{$code}.view.php";
        if (!file_exists($errorView)) {
            $errorView = "404.view.php";
        }
        
        view($errorView, compact('code', 'message'));
        exit();
    }
}

// function routeToController($uri, $routes = [])
// {
//     $controller = $routes[$uri] ?? null;
//     if ($controller && file_exists($controllerPath = base_path($controller))) {
//         require $controllerPath;
//         exit();
//     }

//     abort(404, "Route not Found.");
// }