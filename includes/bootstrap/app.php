<?php

session_start();

$GLOBALS['config'] = include_once('includes/config.php');

spl_autoload_register(function($class) {
    require_once("includes/classes/$class.php");
});

foreach(glob('functions/*') as $function) {
    require_once("includes/functions/$function.php");
}

