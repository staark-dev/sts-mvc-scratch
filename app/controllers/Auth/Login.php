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
        $this->login($this->LoginModel);
    }

    public function index() {
        $this->view('auth/login');
    }

    public function login(LoginModel $model) {
        return $model->login($this->request->data);
    }
}