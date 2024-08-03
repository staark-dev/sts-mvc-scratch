<?php
class Users extends Controller {
    public $users;
    public Request $request;
    public Redirect $redirect;

    public function __construct(Request $request = null)
    {
        $this->users = $this->model('UsersModel');
        $this->request = $request !== null ? $request : new Request;
        $this->redirect = new Redirect;
    }

    public function index() {
        $this->view('users');
    }
}