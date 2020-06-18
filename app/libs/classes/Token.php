<?php

class Token
{
    public static function set()
    {
        return Session::set(
            Config::get('session.token'), 
            md5(uniqid())
        );
    }

    public static function check($token)
    {
        $token_name = Config::get('session.token');

        if(Session::exists($token_name) && 
        $token === Session::get($token_name)) {
            Session::delete($token_name);
            return true;
        }

        return false;
    }
}