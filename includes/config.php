<?php

return array(
    'db' => array(
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'name' => 'oop-auth',
        'charset' => 'utf8'
    ),
    'cookie' => array(
        'name' => 'hash',
        'expiry' => 604800
    ),
    'session' => array(
        'name' => 'user',
        'token' => 'csrf'
    )
);