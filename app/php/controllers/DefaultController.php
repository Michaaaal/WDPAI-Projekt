<?php

require_once 'AppController.php';
class DefaultController extends AppController{

    public function index() {
       $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function evaluate() {
        $this->render('evaluate');
    }

    public function leaderboard() {
        $this->render('leaderboard');
    }

    public function acc() {
        $this->render('acc');
    }
}