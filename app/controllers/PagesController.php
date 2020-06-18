<?php

class PagesController extends Controller
{
    public function index($id = null)
    {
       $this->view('pages/index', array(
           'pages' => $this->model('PageModel')->get()
       ));
    }

    public function create($id = null)
    {

    }
    

    public function store($id = null)
    {

    }

    public function show($id = null)
    {
        if(!isset($id)) {
            return $this->view('errors/404');
        }

        if(is_numeric($id)) {
            $page = $this->model('PageModel')->first(array('id', '=', $id));
        } else {
            $page = $this->model('PageModel')->first(array('slug', '=', $id));
        }

        if(!$page) {
            return $this->view('errors/404');
        }

        $this->view('pages/show', array(
            'page' => $page,
            'created' => new Datetime($page->created),
            'updated' => new Datetime($page->updated)
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