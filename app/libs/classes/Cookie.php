<?php

class Cookie
{
    public static function exists($name)
    {
        return (isset($_COOKIE[$name])) ? true : false;
    }

    public static function set($name, $value, $expiry, $path = '/')
    {
        if(setcookie($name, $value, time() + $expiry, $path)) {
            return true;
        }

        return false;
    }

    public static function get($name)
    {
        if(self::exists($name)) {
            return $_COOKIE[$name];
        }

        return false;
    }

    public static function delete($name)
    {
        self::set($name, '', time() - 1);
    }

}