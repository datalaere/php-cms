<?php

class Token
{
    public static function set()
    {
        return Session::set(
            Config::get('session.token_name'), 
            md5(uniqid())
        );
    }

    public static function get($token)
    {
        $tokenName = Config::get('session.token_name');

        if(Session::exists($tokenName) && 
        $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }

        return false;
    }
}