<?php

namespace Core;

class Container
{
    protected array $bindings = [];
    
    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve($key)
    {
        if ($resolver = $this->bindings[$key] ?? null) {
            return call_user_func($resolver);
        }

        throw new \Exception("Cannot resolve for binding key '{$key}'.");
    }
}
