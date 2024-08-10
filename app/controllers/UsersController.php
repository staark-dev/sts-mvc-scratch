<?php
class UsersController extends Controller {
    /**
     * @throws exception
     */
    public function index() {
        $this->view('users', $this->model->getUsers());
    }
}