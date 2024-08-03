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

    public function post() {
        if($this->request->isPost()) {
            var_dump($this->request->data);
            if($this->dbh->insert('accounts', $this->request->data)) {
                $this->redirect->to('home');
            } else {
                $this->redirect->to('home');
            }
        } else {
            print_r($this->request->data);
            return false;
        }
    }
}