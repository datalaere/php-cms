<?php

class Auth extends UserModel
{
    private $_db;
    private $_auth;
    private $_session_name;
    private $_cookie_name;
    private $_cookie_expiry;

    public function __construct($user = null)
    {    
        $this->_db = DB::singleton();
        $this->_session_name = Config::get('session.name');
        $this->_cookie_name = Config::get('cookie.name');
        $this->_cookie_expiry = Config::get('cookie.expiry');

        if(!$user) {
            if(Session::exists($this->_session_name)) {

                $user = Session::get($this->_session_name);
                if($this->find($user)) {
                    $this->_auth = true;
                } else {
                    $this->logout();
                }
            }
        } else {
            $this->find($user);
        }
    }

    public function login($username = null, $password = null, $remember = false)
    {
        if(!$username && !$password && $this->exists()) {
            Session::set($this->_session_name, $this->getUserId());
        } else {
        
            $user = $this->find($username);

            if($user) {
                if(password_verify($password, $this->data()->password)) {
                    Session::set($this->_session_name, $this->getUserId());
                    
                    if($remember) {

                        $hash = Hash::unique();

                        if(!$this->getUserSession()) {
                            $this->_db->update($this->_table, $this->getUserId(), array(
                                $this->_fields['SESSION'] => $hash
                            ));
                        } else {
                            $hash = $this->getUserSession();
                        }

                        Cookie::set($this->_cookie_name, $hash, $this->_cookie_expiry);
                    }

                    return true;
                }
            }
        }

        return false;
    }

    public function role($key)
    {
        $role = json_decode($this->data()->role, true);
        
        if($role[$key] == true) {
            return true;
        }

        return false;
    }

    public function logout()
    {
        Session::delete($this->_session_name);

        $this->_db->update($this->_table, $this->getUserId(), array(
            $this->_fields['SESSION'] => ''
        ));

        Cookie::delete($this->_cookie_name);
    }

    public function check()
    {
        return $this->_auth;
    }
}