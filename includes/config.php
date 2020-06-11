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
    'remember' => array(
        'name' => 'hash',
        'expiry' => 604800
    ),
    'session' => array(
        'name' => 'user',
        'token_name' => 'csrf'
    )
);