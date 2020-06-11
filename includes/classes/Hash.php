<?php

class Hash
{
    public static function make($string, $salt = '')
    {
        return hash('sha256', $string . $salt);
    }

    public static function salt($length)
    {
        // mcrypt_create_iv() is removed in PHP 7
        return random_bytes($length);
    }

    public static function unique()
    {
        return self::make(uniqid());
    }
}