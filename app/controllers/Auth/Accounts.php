<?php
class Accounts extends Controller {
    public $AccountsModel;
    public Request $request;
    public Redirect $redirect;

    //use AccountsModel;

    public function __construct(Request $request = null)
    {
        $this->AccountsModel = $this->model('AccountsModel');
        $this->request = $request !== null ? $request : new Request;
        $this->redirect = new Redirect;
        $this->create($this->AccountsModel);
    }

    public function index() {
        $users = $this->AccountsModel->show();
        $this->view('auth/accounts', $users);
    }

    public function create(AccountsModel $model) {
        return $model->create();
    }
}