<!DOCTYPE html>
<head>
    <title> Leaderboard </title>
    <link rel="stylesheet" type="text/css" href="app/css/background.css">
    <link rel="stylesheet" type="text/css" href="app/css/styleLeaderboard.css">
    <script type="text/javascript" src="./app/js/searchTopic.js" defer></script>
</head>
<body>
     <?php include 'app/views/topic.php'?>
     <?php include 'app/views/menu.php'?>
    <div class="search-bar">
        <input placeholder="search topic">
    </div>
    <section class="topics">
    </section>

     <div id="topicNameDisplay"></div>

     <section class="images">
         <?php
         echo "<div id=\"topicNameDisplay\">".$_SESSION["topicName"]."</div>";
         include_once 'app/php/controllers/CompetitionController.php';
         $competitionController = new CompetitionController();
         $competitionController->displayCompetitionImagesForTopic();
         ?>
     </section>
</body>
<template id="topicTemplate">
    <div class="topicTemplate">
        <b class="rainbow">topic</b>
        <i class="topicStartDate">startDate</i>
        <i class="topicEndDate">endDate</i>
    </>
</template>

<template id="project-template">
    <div id="" class="imgPlusDesc">
        <img class="uploadedIMG" src="">
        <div class="uploadedIMG">
            <p>description</p>
            <div class="social-section">
               likes <i class="fas fa-heart"> 0</i><br>
               dislikes <i class="fas fa-minus-square"> 0</i>
            </div>
        </div>
    </div>
</template>