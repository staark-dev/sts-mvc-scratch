<?php
class Home extends Controller {
    
    public function index() {
        //var_dump($this->query("SELECT * FROM `accounts` ORDER BY uID DESC LIMIT 0, 10"));
        $this->view('welcome');
    }
}