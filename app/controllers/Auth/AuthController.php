<?php
namespace Auth;

class AuthController extends \Controller {
    public array $errors = [];
    /**
     * @throws \exception
     */
    public function loginIndex() {
        $this->view('auth/login');
    }

    /**
     * @throws \exception
     */
    public function signupIndex() {
        $this->view('auth/signup');
    }

    public function login() {
        $this->model->loginSave();
    }

    public function create() {

    }

    /**
     * @throws \exception
     */
    public function profile() {
        $this->view('user_profile', $this->model->findById());
    }

    public function sign_out() {
        unset($_SESSION['user']);
        unset($_SESSION['user_session']);
        redirect('some/url');
    }
}