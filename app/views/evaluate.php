<!DOCTYPE html>
<head>
    <title> Evaluate </title>
    <link rel="stylesheet" type="text/css" href="app/css/background.css">
    <script type="text/javascript" src="app/js/searchForEvaluation.js" defer></script>
</head>

<body>

<div class="photo-container">
    <div id="photo" class="photo"></div>
</div>
    <?php include 'app/views/topic.php' ?>
    <?php include 'app/views/menu.php' ?>

    <?php
    if(isset($image[0])){
        $imagePath = "app/iuploadsTMP/";
        $imagePath .=$image[0]->getImage();
        echo '<img class="uploadedIMG" src="' . $imagePath . '" alt="Competition Image">';
        echo '<p class="uploadedIMG">' . $image[0]->getDescription() . '</p>';
    }else{
        echo "ALL IMAGES EVALUATED";
    }
    ?>

    <form method="POST" action="evaluateCI">
        <input type="hidden" name="photoId" value="<?php echo $image[0]->getId(); ?>">
        <input type="hidden" name="like" value="true">
        <button type="submit" class="button">Like</button>
    </form>

    <form method="POST" action="evaluateCI">
        <input type="hidden" name="photoId" value="<?php echo $image[0]->getId(); ?>">
        <input type="hidden" name="like" value="false">
        <button type="submit" class="button">Dislike</button>
    </form>

</body>