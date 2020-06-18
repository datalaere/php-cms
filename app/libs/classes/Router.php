<?php

class Router
{
    protected $_controllers = '';
    protected $_controller = 'DefaultController';
    protected $_method = 'index';
    protected $_params = array();

    public function __construct($controllers)
    {
        $this->_controllers = $controllers;

        $url = $this->parseUrl();

        if(isset($url) && file_exists("{$this->_controllers}/{$url[0]}Controller.php")) {
            $this->_controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        require_once("{$this->_controllers}/{$this->_controller}.php");

        $this->_controller = new $this->_controller;

        if(isset($url[1])) {
            if(method_exists($this->_controller, $url[1])) {
               $this->_method = $url[1];
               unset($url[1]);
            }
        }

        $this->_params = $url ? array_values($url) : [];

        call_user_func_array(array($this->_controller, $this->_method), $this->_params);
    }

    private function parseUrl()
    {
        if(isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    } 
}