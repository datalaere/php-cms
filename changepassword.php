<?php

require_once('includes/bootstrap/app.php');

$user = new Auth();

if(!$user->auth()) {
    Response::redirect('index.php');
}

if(Request::exists()) {
    if(Token::check(Request::get('token'))) {

        $v = new Validate();
        $validation = $v->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));

        if($validation->passed()) {
            try {

                $user->update(array(
                    'name' => Request::get('name')
                ));

                Session::flash('success', 'Details updated!');
                Response::redirect('index.php');

            } catch(Exception $error) {
                die($error->getMessage());
            }
        } else {
            foreach($validation->errors() as $error) {
                echo "<p>$error</p>";
            }
        }
    }
}

?>
<form action="" method="POST">
<div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="<?php  esc(Request::get('password'));  ?>" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php esc(Token::set()); ?>">
    <input type="submit" value="Save">
</form>