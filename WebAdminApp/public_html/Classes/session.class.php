<?php

class Session 
{
    const USER = "user";
    const ROLE = "role";
    const ID = "id";
    const SESSION_NAME = "login";

    static function createSession()
    {
        session_name(self::SESSION_NAME);

        if (session_id() == "") 
        {
            session_start();
        }
    }
    static function createUser($user, $role, $id)
    {
        self::createSession();
        $_SESSION[self::USER] = $user;
        $_SESSION[self::ROLE] = $role;
        $_SESSION[self::ID] = $id;
    }
    static function getUser()
    {

    }
    static function deleteSession()
    {

    }
}

?>