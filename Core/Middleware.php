<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;

class Middleware
{
    const MAP = [
        'auth' => Auth::class,
        'guest' => Guest::class,
    ];

    public static function resolve($key)
    {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key] ?? false;
        if (!$middleware) {
            throw new \Exception("Middleware Key '{$key}' not found.");
        }

        (new $middleware)->handle();
    }
}
