<?php
require_once('includes/bootstrap/app.php');

if(Request::exists()) {
    if(Token::check(Request::get('token'))) {
        $v = new Validate();

        $validation = $v->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validation->passed()) {

            $user = new Auth();

            $remember = (Request::get('remember') === 'on') ? true : false;

            $login = $user->login(
                Request::get('username'),
                Request::get('password'),
                $remember
            );

            if($login) {
                Session::flash('success', 'You logged in successfully!');
                Response::redirect('index.php');
            } else {
                echo '<p>Login failed</p>';
            }

        }  else {
            foreach($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}

?>
<form action="" method="POST">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php  esc(Request::get('username'));  ?>" autocomplete="off">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="<?php  esc(Request::get('password'));  ?>" autocomplete="off">
    </div>

    <div class="field">
        <label for="remember">
            <input type="checkbox" name="remember" id="remember">Remember me
        </label>
    </div>

    <input type="hidden" name="token" value="<?php esc(Token::set()); ?>">
    <input type="submit" value="Login">
</form>