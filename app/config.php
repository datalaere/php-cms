<?php

return array(
    'app' => array(
        'name' => 'app',
        'url' => 'http://localhost/github/php-oop-login-register-system',
        'errors' => true,
        'abspath' => dirname(__DIR__),
        'views' => dirname(__DIR__) . '/app/views/'
    ),
    'db' => array(
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'name' => 'php-cms',
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