<?php
    require_once('includes/bootstrap/app.php');

if(Request::exists()) {
    if(!Token::get(Request::get('token'))) {
        if(Request::exists()) {
            $v = new Validate();
            $check = $v->check($_POST, array(
                'name' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 50
                ),
                'username' => array(
                    'name' => 'Username',
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'users'
                ),
                'password' => array(
                    'required' => true,
                    'min' => 6
                )
            ));

            if($check->passed()) {
                
                $user = new Auth();
                $salt = Hash::salt(32);
                try {
                    $user->create(array(
                        'username' => Request::get('username'),
                        'password' => Hash::make(Request::get('password'), $salt),
                        'salt' => $salt,
                        'name' => Request::get('name'),
                        'joined' => date('Y-m-d H:i:s'),
                        'role' => 1
                    ));

                    Session::flash('success', 'You registered successfully!');
                    
                } catch(Exception $error) {
                    die($error->getMessage());
                }

            } else {
                foreach($check->errors() as $error) {
                    echo $error, '<br>';
                }
            }
        }
    }
}
?>
<form action="" method="POST">
    <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php  esc(Request::get('name'));  ?>" autocomplete="off">
    </div>

    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php  esc(Request::get('username'));  ?>" autocomplete="off">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="<?php  esc(Request::get('password'));  ?>" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php esc(Token::set()); ?>">
    <input type="submit" value="Register">
</form>