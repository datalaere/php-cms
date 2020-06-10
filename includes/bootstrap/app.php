<?php

session_start();

$GLOBALS['config'] = include_once('includes/config.php');

spl_autoload_register(function($class) {
    require_once("includes/classes/$class.php");
});

foreach(glob('includes/functions/*') as $function) {
    require_once($function);
}

