<?php

namespace Core\Middleware;

use Core\Session;

class VerifyCsrf
{
    public function handle()
    {
        static::verify();
    }

    public static function tokenMatch()
    {
        $token = $_POST['_token'] ?? null;

        return Session::get('_token') === $token;
    }

    public static function verify()
    {
        if (!static::tokenMatch()) {
            // redirect('/');
            dd('token not match');
        }
    }
}
