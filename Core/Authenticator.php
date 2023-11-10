<?php

namespace Core;

class Authenticator
{
    protected ?array $user = null;

    public function attempt($username, $password)
    {
        /** @var \Core\Database $db  */
        $db = App::resolve(Database::class);

        $user = $db->query('select * from users where username = :username', [':username' => $username])->find();

        if ($user && password_verify($password, $user['password'])) {
            $this->setUser($user);

            return $user;
        }

        return false;
    }

    public function attemptLogin($username, $password)
    {
        if ($user = $this->attempt($username, $password)) {
            $this->login($user);

            return true;
        }

        return false;
    }

    public function setUser($user)
    {
        unset($user['password']);

        $this->user = $user;

        return $this;
    }

    public function user($attribute = null)
    {
        if ($attribute) {
            return $this->user[$attribute] ?? null;
        }

        return $this->user;
    }

    public function login($user)
    {
        Session::put('user', [
            'id' => $user['id'],
            'username' => $user['username'],
        ]);

        $this->setUser($user);

        session_regenerate_id(true);
    }

    public function logout()
    {
        $this->setUser(null);

        Session::destroy();
    }
}
