<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/CompetitionPhotoRepository.php';
class DefaultController extends AppController{

    public function index() {
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function evaluate() {
        $this->checkIfLoggedIn();
        $userId = $_SESSION["userId"];
        $repo = new \repository\CompetitionPhotoRepository();
        $image = $repo->getCPbyUserNotEvaluatedSingle($userId);

        $this->render('evaluate', ['image' => [$image]]);
    }

    public function leaderboard() {
        $this->checkIfLoggedIn();
        $this->render('leaderboard');
    }

    public function acc() {
        $this->checkIfLoggedIn();
        $this->render('acc');
    }
}