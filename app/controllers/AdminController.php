<?php

class AdminController extends Controller
{

    public function __construct()
    {

    }

    public function index($id = null)
    {
    
        $this->view('admin/index');
    }

    public function create($id = null)
    {

    }

    public function store($id = null)
    {

    }

    public function show($id = null)
    {
        $this->view("admin/$id", array(
            'pages' => $this->model('PageModel')->get()
        ));
    }

    public function edit($id = null)
    {

    }

    public function update($id = null)
    {

    }

    public function destroy($id = null)
    {

    }
    
}