<?php require_once 'app/php/controllers/CompetitionController.php'; ?>
<!DOCTYPE html>
<head>
    <title> Post/Account </title>
    <link rel="stylesheet" type="text/css" href="app/css/background.css">
    <link rel="stylesheet" type="text/css" href="app/css/accStyle.css">
</head>

<body>
    <?php include 'app/views/menu.php' ?>
    
    <div class="container">



            <div class="addCompetitionPhoto">
            <div class="header1">POST</div>

                <form action="addCP" method="POST" ENCTYPE="multipart/form-data">
                    <?php
                    if(isset($messeges)){
                        foreach ($messeges as $message){
                            echo $message;
                        }
                    }
                    ?>

                    <div>
                        <label for="fileInput" class="customButton"><img class="addPhoto" src="app/img/addPhoto.svg"></label>
                        <input id="fileInput" class="fileInput" type="file" name="file" >
                    </div>

                    <div class="descriptionCont"><textarea class="description" name="description" rows="5" placeholder="Add description"></textarea></div>

                    <div><button id="submitButton" type="submit">POST</button></div>
                </form>

                <div id='messages1'>
                    <?php
                    if(isset($messages)){
                        foreach ($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>

                <div class="header1">
                    UPLOADED
                </div>

                <div>
                    <img class="uploadedIMG" src="app/iuploadsTMP/<?php if ($competitionPhoto != null) {
                        $description = $competitionPhoto->getImage();
                        if (!empty($description)) {
                            echo $description;
                        }
                    }else{
                        echo 'No-Photo.jpg';
                    }
                    ?>">

                    <?php displayCompetitionImage(); ?>
                </div>

                <div class="uploadedDesc">
                    <?php if ($competitionPhoto != null) {
                        $description = $competitionPhoto->getDescription();
                        if (!empty($description)) {
                            echo $description;
                        }
                    }else{
                        echo 'Lack of description';
                    } ?>
                </div>

            </div>



            <div class="divider"></div>



            <div class="accountCont">
                <div class="header1">ACCOUNT</div>
                <div class="inputCont">
                    <input name="changeNickname" placeholder="Nickname">
                    <input name="changeEmail"  placeholder="E-mail">
                    <input name="phoneNumber"  placeholder="Phone Num">
                    <input id="changeDesc" name="description"  placeholder="Account description">
                    <button id="button1" > APPLY CHANGES </button>
                </div>

                <div class="header1">GALLERY</div>
                

            </div>


    </div>


</body>