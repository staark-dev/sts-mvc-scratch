<?php

class AccountsModel extends Model
{
    private Database $dbh;
    private Request $request;
    private Redirect $redirect;

    public function __construct(Request $request = null)
    {
        $this->dbh = new Database;
        $this->request = $request !== null ? $request : new Request;
        $this->redirect = new Redirect;
    }

    public function create() {
        if($this->request->isPost()) {
            
            if($this->dbh->insert('accounts', $this->request->data)) {
                $this->redirect->to('home');
            } else {
                $this->redirect->to('home');
            }
        } else {
            return false;
        }
    }

    public function show() {
        if($this->request->isGet()) {
            return $this->dbh->query_result_array("SELECT * FROM `accounts`");
        }
    }
}