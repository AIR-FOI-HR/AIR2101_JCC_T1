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
    static function createUser()
    {

    }
    static function getUser()
    {

    }
    static function deleteSession()
    {

    }
}

?>