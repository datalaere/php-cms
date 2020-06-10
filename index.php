<?php

require_once('includes/bootstrap/app.php');

$users = DB::singleton()->get('users', array('username', '=', 'admin'));

var_dump($users);

/*
if($users->count()) {
    foreach ($users as $user) {
        echo $user->username;
    }
}
*/