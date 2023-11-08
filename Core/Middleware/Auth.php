<?php

namespace Core\Middleware;

class Auth
{
    public function handle()
    {
        $hasSession = $_SESSION['user'] ?? false;
        if (!$hasSession) {
            header('location: /');
            exit();
        }
    }
}
