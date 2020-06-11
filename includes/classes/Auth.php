<?php

class Auth
{
    private $_db;
    private $_table = 'users';

    public function __construct($user = null)
    {    
        $this->_db = DB::singleton();
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert($this->_table, $fields)) {
            throw new Exception('Error creating user!');
        }
    }
}