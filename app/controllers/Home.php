<?php
class Home extends Controller {
    public $home;
    public Request $request;
    public Redirect $redirect;

    public function __construct(Request $request = null)
    {
        $this->home = $this->model('HomeModel');
        $this->request = $request !== null ? $request : new Request;
        $this->redirect = new Redirect;
    }

    public function index() {
        $this->view('welcome');
    }

    public function store() {
        if($this->request->isPost()) {
            $insert = $this->home->store();
        }
    }
}