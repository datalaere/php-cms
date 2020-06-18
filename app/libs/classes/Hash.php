<?php

class Hash
{
    public static function make($string)
    {
        return hash('sha256', $string);
    }

    public static function verify($string, $hash)
    {
        if(self::make($string) === $hash)  {
            return true;
        }

        return false;
    }

    public static function random($length)
    {
        // mcrypt_create_iv() is removed in PHP 7
        return bin2hex(random_bytes($length));
    }

    public static function unique()
    {
        return self::make(uniqid());
    }
}