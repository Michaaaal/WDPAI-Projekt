<!DOCTYPE html>
<head>
    <title> Evaluate </title>
    <link rel="stylesheet" type="text/css" href="app/css/styleEvaluate.css">
    <script type="text/javascript" src="app/js/searchForEvaluation.js" defer></script>
</head>

<body>
<div class="photo-container">
    <?php include 'app/views/topic.php' ?>
    <?php include 'app/views/menu.php' ?>

    <?php
    if(isset($image[0])){
        $imagePath = "app/iuploadsTMP/";
        $imagePath .=$image[0]->getImage();
        echo '<img class="IMG" id="myImage" src="' . $imagePath . '" alt="Competition Image">';
        echo '<p class="uploadedIMG">' . $image[0]->getDescription() . '</p>';
    }else{
        echo "<div class='rainbow' id='AllImagesEval'>ALL IMAGES EVALUATED</div>";
    }
    ?>

    <div class="buttons-container">
        <form method="POST" action="evaluateCI">
            <input type="hidden" name="photoId" value="<?php echo $image[0]->getId(); ?>">
            <input type="hidden" name="like" value="true">
            <button type="submit" class="buttonE" id="like">Like</button>
        </form>

        <form method="POST" action="evaluateCI">
            <input type="hidden" name="photoId" value="<?php echo $image[0]->getId(); ?>">
            <input type="hidden" name="like" value="false">
            <button type="submit" class="buttonE" id="dislike">Dislike</button>
        </form>
    </div>

    <script>
        window.onload = function() {
            var image = document.getElementById('myImage');
            image.style.boxShadow = `0px 100px 300px 1px ${generateRandomColor()}`;
        };

        function generateRandomColor() {
            var r = Math.floor(Math.random() * 256); // Losowa wartość czerwona
            var g = Math.floor(Math.random() * 256); // Losowa wartość zielona
            var b = Math.floor(Math.random() * 256); // Losowa wartość niebieska
            return `rgba(${r}, ${g}, ${b}, ${0.2})`;
        }
    </script>

</div>
</body>