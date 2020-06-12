<?php

class Auth
{
    private $_db;
    private $_data;
    private $_session_name;
    private $_table = 'users';
    private $_fields = array(
        'id' => 'id',
        'username' => 'username'
    );

    public function __construct($user = null)
    {    
        $this->_db = DB::singleton();
        $this->_session_name = Config::get('session.session_name');
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert($this->_table, $fields)) {
            throw new Exception('Error creating user!');
        }
    }

    public function find($user = null)
    {
        if($user) {

            $field = (is_numeric($user)) ? $this->_fields['id'] : $this->_fields['username'];
            $data = $this->_db->get($this->_table, array($field, '=', $user));
            
            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }

        return false;
    }

    public function login($username = null, $password = null)
    {
        $user = $this->find($username);

        if($user) {
            if($this->data()->password === 
            Hash::make($password, $this->data()->salt)) {
                Session::set($this->_session_name, $this->data()->id);
                return true;
            }
        }

        return false;
    }

    private function data()
    {
        return $this->_data;
    }
}