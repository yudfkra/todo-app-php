<?php

namespace Core;

class Authenticator
{
    public function attempt($username, $password)
    {
        /**
         * @var \Core\Database $db
         */
        $db = App::resolve(Database::class);

        $user = $db->query('select * from users where username = :username', [':username' => $username])->find();

        if ($user && password_verify($password, $user['password'])) {
            $this->login($user);

            return true;
        }

        return false;
    }

    public function login($user)
    {
        Session::put('user', [
            'id' => $user['id'],
            'username' => $user['username'],
        ]);

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
