<?php

abstract class Controller
{
    protected function model($model, $params = null)
    {
        require_once(Config::get('app.abspath') . "/app/models/{$model}.php");
        return new $model($params);
    }

    protected function view($view, $data = array())
    {
        require_once(Config::get('app.abspath') . "/app/views/{$view}.php");
    }

    protected function index($id = null)
    {

    }

    protected function create($id = null)
    {

    }

    protected function store($id = null)
    {

    }

    protected function show($id = null)
    {

    }

    protected function edit($id = null)
    {

    }

    protected function update($id = null)
    {

    }

    protected function destroy($id = null)
    {

    }
}