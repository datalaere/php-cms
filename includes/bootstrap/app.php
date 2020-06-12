<?php

session_start();

$GLOBALS['config'] = include_once('includes/config.php');

spl_autoload_register(function($class) {
    require_once("includes/classes/$class.php");
});

foreach(glob('includes/functions/*') as $function) {
    require_once($function);
}

if(Cookie::exists(Config::get('cookie.name')) && !Session::exists(Config::get('session.name'))) {
    $hash = Cookie::get(Config::get('cookie.name'));
    $user = DB::singleton()->get('users', array('session', '=', $hash));

    if($user->count()) {
        $user = new Auth($user->first()->id);
        $user->login();
    }
}
