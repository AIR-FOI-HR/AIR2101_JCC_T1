<?php

class Session 
{
    const USER = "user";
    const ROLE = "role";
    const ID = "id";
    const MUSEUM = "museum";
    const SESSION_NAME = "login";

    static function createSession()
    {
        session_name(self::SESSION_NAME);

        if (session_id() == "") 
        {
            session_start();
        }
    }
    static function createUser($user, $role, $id, $museum)
    {
        self::createSession();
        $_SESSION[self::USER] = $user;
        $_SESSION[self::ROLE] = $role;
        $_SESSION[self::ID] = $id;
        $_SESSION[self::MUSEUM] = $museum;
    }
    static function getUser()
    {
        self::createSession();
        if (isset($_SESSION[self::USER])) 
        {
            $user[self::USER] = $_SESSION[self::USER];
            $user[self::ROLE] = $_SESSION[self::ROLE];
            $user[self::ID] = $_SESSION[self::ID];
            $user[self::MUSEUM] = $_SESSION[self::MUSEUM];
        } else {
            return null;
        }
        return $user;
    }
    static function deleteSession()
    {
        session_name(self::SESSION_NAME);

        if (session_id() != "") {
            session_unset();
            session_destroy();
        }
    }
}

?>