<?php

namespace Core\Middleware;

use Core\Middleware\Auth;
use Core\Middleware\AuthApi;
use Core\Middleware\Guest;
use Core\Middleware\VerifyCsrf;

class Middleware
{
    const MAP = [
        'auth' => Auth::class,
        'auth.api' => AuthApi::class,
        'guest' => Guest::class,
        'verify.csrf' => VerifyCsrf::class,
    ];

    public static function resolve($key)
    {
        if (!$key) {
            return;
        }

        $middlewares = !is_array($key) && is_string($key) ? [$key] : $key;
        foreach ($middlewares as $middlewareKey) {
            $middleware = static::MAP[$middlewareKey] ?? false;
            if (!$middleware) {
                throw new \Exception("Middleware Key '{$key}' not found.");
            }

            (new $middleware)->handle();
        }
    }
}
