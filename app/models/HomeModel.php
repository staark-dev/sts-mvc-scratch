<?php

class HomeModel extends Model {
    private Database $dbh;
    private Request $request;
    private Redirect $redirect;

    public function __construct(Request $request = null)
    {
        $this->dbh = new Database;
        $this->request = $request !== null ? $request : new Request;
        $this->redirect = new Redirect;
    }
}