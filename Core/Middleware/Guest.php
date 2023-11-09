<?php

namespace Core\Middleware;

class Guest
{
    public function handle()
    {
        $hasSession = $_SESSION['user'] ?? false;
        if ($hasSession) {
            redirect();
        }
    }
}
