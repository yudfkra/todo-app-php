<?php

namespace Core\Middleware;

use Core\Session;

class Guest
{
    public function handle()
    {
        if (Session::has('user')) {
            redirect();
        }
    }
}
