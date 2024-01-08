<?php session_start(); ?>
<!DOCTYPE html>
<head>
    <title>Capturly</title>
    <link rel="icon" href="app/img/logo.ico" type="image/x-icon">

</head>

<body><?php
    require 'Routing.php';

    $path = trim($_SERVER['REQUEST_URI'],'/');
    $path = parse_url($path, PHP_URL_PATH);

    Routing::post('login','SecurityController');
    Routing::post('registerUser','SecurityController');
    Routing::post('changeAcc','SecurityController');
    Routing::get('register','DefaultController');
    Routing::get('','DefaultController');
    Routing::get('evaluate','DefaultController');
    Routing::get('acc','DefaultController');
    Routing::get('leaderboard','DefaultController');
    Routing::get('topic','DefaultController');
    Routing::post('addCP','CompetitionController');
    Routing::post('logout','SecurityController');
    Routing::post('searchForEvaluation','CompetitionController');
    Routing::post('evaluateCI','CompetitionController');
    Routing::run($path);

?>
</body>
