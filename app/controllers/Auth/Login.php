<?php
class Login extends Controller {
    public $LoginModel;
    public Request $request;
    public Redirect $redirect;

    public function __construct(Request $request = null)
    {
        $this->LoginModel = $this->model('LoginModel');
        $this->request = $request !== null ? $request : new Request;
        $this->redirect = new Redirect;
    }

    public function index() {
        $this->view('auth/login');
    }
}