<?php
namespace Auth;

use http\Env\Response;
use Http\Request;

class AuthController extends \Controller {
    /**
     * @throws \exception
     */
    public function loginIndex() {
        $this->view('auth/login', $this->model->errors ?? []);
    }

    /**
     * @throws \exception
     */
    public function signupIndex() {
        $this->view('auth/signup', $this->model->errors ?? []);
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
        $this->response->to('/');
    }
}