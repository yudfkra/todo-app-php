<?php

namespace Core;

class Container
{
    protected array $bindings = [];

    protected array $instances = [];
    
    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve($key)
    {
        if ($instance = $this->instances[$key] ?? null) {
            return $instance;
        }

        if ($resolver = $this->bindings[$key] ?? null) {
            $resolved = call_user_func($resolver);

            return $this->instances[$key] = $resolved;
        }

        throw new \Exception("Cannot resolve for binding key '{$key}'.");
    }
}
