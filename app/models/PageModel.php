<?php

class PageModel
{
    private $_db;
    private $_table = 'pages';

    public function __construct()
    {
        $this->_db = DB::singleton();
    }

    public function first($where = array())
    {
       return $this->_db->get($this->_table, $where)->first();
    }

    public function get($where = array())
    {
       return $this->_db->get($this->_table, $where)->results();
    }

}