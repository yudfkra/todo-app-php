<?php

namespace Core;

class Router
{
    protected array $routes = [];

    public function get($uri, $controller)
    {
        $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        $this->add('DELETE', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        $this->add('PUT', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        $this->add('PATCH', $uri, $controller);
    }

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
        ];
    }

    public function route($uri, $method = 'GET')
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                $controller = base_path($route['controller']);
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