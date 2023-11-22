<!DOCTYPE html>
<head>
    <title>Capturly</title>
    <link rel="icon" href="app/img/logo.svg" type="image/x-icon">
</head>

<body>
    <?php
    require 'Routing.php';
    
    $path = trim($_SERVER['REQUEST_URI'],'/');
    $path = parse_url($path, PHP_URL_PATH);
    
    Routing::get('login','DefaultController');
    Routing::get('register','DefaultController');
    Routing::get('evaluate','DefaultController');
    Routing::get('acc','DefaultController');
    Routing::get('leaderboard','DefaultController');
    Routing::run($path);

   // include 'app/views/menu.html'; 
   // include 'app/views/acc.html';

    ?>
   
    
</body>
</html>