<?php
class Accounts extends Controller {
    public $AccountsModel;
    public Http\Request $request;
    public Http\Redirect $redirect;

    public function __construct(Http\Request $request = null)
    {
        $this->AccountsModel = $this->loadModel('UserModel');
        $this->request = $request !== null ? $request : new Http\Request;
        $this->redirect = new Http\Redirect;
    }

    public function index() {
        
        $this->view('users_views', $this->AccountsModel->profile());
    }
}