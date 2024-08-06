<?php
namespace Auth;

class LoginController extends \Controller {

    public function __construct()
    {
        // Loading specific model from this controller
        $this->model = $this->loadModel('User');
    }

    public function index() {
        $this->view('auth/login');
    }

    public function save() {

    }
}