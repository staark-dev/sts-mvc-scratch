<?php
class UsersController extends Controller {
    public function index() {
        $this->view('users', $this->model->getUsers());
    }
}