<?php

namespace Core\Middleware;

use Core\App;
use Core\Authenticator;
use Core\Responses\Json;

class AuthApi
{
    protected Authenticator $auth;

    protected $parsedUsername = null;

    protected $parsedPassword = null;

    public function __construct()
    {
        $this->parseAuthorization();

        $this->auth = App::resolve(Authenticator::class);
    }

    public function handle()
    {
        $validLogin = $this->auth->attempt($this->getUsername(), $this->getPassword());
        if (!$validLogin) {
            return Json::unauthorized()->output();
        }
    }

    protected function parseAuthorization()
    {
        $authHeader = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : '';
        if ($authHeader) {
            [$authType, $authCredentials] = explode(' ', $authHeader, 2);

            if ($authType === 'Basic' && ($authCredentials = base64_decode($authCredentials))) {
                [$username, $password] = explode(':', $authCredentials, 2);

                $this->parsedUsername = $username;
                $this->parsedPassword = $password;
            }
        }
    }

    protected function getUsername()
    {
        return $this->parsedUsername ?? $_SERVER['PHP_AUTH_USER'] ?? null;
    }

    protected function getPassword()
    {
        return $this->parsedPassword ?? $_SERVER['PHP_AUTH_PW'] ?? null;
    }
}
