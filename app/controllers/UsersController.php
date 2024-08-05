<?php
class UsersController extends Controller {
    public function index() {
        var_dump($this->modelName);
        $this->view('users', []); //$this->model->get()
    }
}