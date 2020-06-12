<?php

require_once('includes/bootstrap/app.php');

//$users = DB::singleton()->get('users', array('username', '=', 'admin'));

/*
DB::singleton()->update('users', 2, array(
    'username' => 'test2',
    'password' => 'pass2'
));
*/

//var_dump($users);

/*
if($users->count()) {
    foreach ($users as $user) {
        echo $user->username;
    }
}
*/

if(Session::exists('success')) {
    echo Session::flash('success');
}

$user = new Auth();
if($user->auth()) {
?>
<p>Hello <a href="#"><?php esc($user->data()->username); ?></a>!</p>
<ul>
    <li><a href="logout.php">Log out</a></li>
</ul>
<?php
} else {
?>
<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a></p>
<?php
}