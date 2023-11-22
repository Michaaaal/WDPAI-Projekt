<?php

require_once 'AppController.php';
class DefaultController extends AppController{

    public function login() {
       $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function evaluate() {
        $this->render('menu');
        $this->render('evaluate');
    }

    public function leaderboard() {
        $this->render('menu');
        $this->render('leaderboard');
    }

    public function acc() {
        $this->render('menu');
        $this->render('acc');
    }
}