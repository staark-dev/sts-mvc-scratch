<?php
class Accounts extends Controller {
    public $AccountsModel;
    public Request $request;
    public Redirect $redirect;

    public function __construct(Request $request = null)
    {
        $this->AccountsModel = $this->model('UserModel');
        $this->request = $request !== null ? $request : new Request;
        $this->redirect = new Redirect;
    }

    public function index() {
        
        $this->view('users_views', $this->AccountsModel->profile());
    }
}