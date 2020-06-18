<?php

class UserModel extends Auth
{
    private $_db;
    private $_data;
    private $_table = 'users';
    private $_fields = array(
        'ID' => 'id',
        'USERNAME' => 'username',
        'SESSION' => 'session'
    );

    public function __construct()
    {
        $this->_db = DB::singleton();
    }

    public function update($fields = array(), $id = null)
    {
        if(!$id && $this->auth()) {
            $id = $this->getUserId();
        }

        if(!$this->_db->update($this->_table, $id, $fields)) {
            throw new Exception('Error updating user!');
        }
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

            $field = (is_numeric($user)) ? $this->_fields['ID'] : $this->_fields['USERNAME'];
            $data = $this->_db->get($this->_table, array($field, '=', $user));
            
            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }

        return false;
    }

    public function getUserId()
    {
        return $this->data()->id;
    }

    public function getUserSession()
    {
        return $this->data()->session;
    }

    public function exists()
    {
        return (!empty($this->data())) ? true : false;
    }

    public function data()
    {
        return $this->_data;
    }
}