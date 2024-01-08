<!DOCTYPE html>
<head>
    <title> Post/Account </title>
    <link rel="stylesheet" type="text/css" href="app/css/background.css">
    <link rel="stylesheet" type="text/css" href="app/css/accStyle.css">
</head>

<body>
    <?php include 'app/views/topic.php' ?>
    <?php include 'app/views/menu.php' ?>

    <div class="container">

            <div class="addCompetitionPhoto">
            <div class="header1">POST</div>

                <form action="addCP" method="POST" ENCTYPE="multipart/form-data">


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
                    UPLOADED ON THIS TOPIC
                </div>

                <div class="uploadedImg">
                   <?php
                    include_once 'app/php/controllers/CompetitionController.php';
                    $competitionController = new CompetitionController();
                    $competitionController->displayCompetitionImagesUploaded();
                    ?>
                </div>



            </div>



            <div class="divider"></div>



            <div class="accountCont">
                <div class="header1">ACCOUNT</div>
                <form action="changeAcc" method="post">
                <div class="inputCont">
                    <?php $userRepository = new UserRepository();
                    $user = $userRepository->getUserById($_SESSION['userId']);
                    ?>
                    <input name="changeNickname" placeholder="Nickname: <?php echo $user->getName()?>" autocomplete="off">
                    <input name="changePassword" oninput="maskInput(this)" placeholder="changePassword" autocomplete="off">
                    <input name="repeatPassword" oninput="maskInput(this)" placeholder="repeatPassword" autocomplete="off">
                    <input name="phoneNumber"  placeholder="Phone Num: <?php echo $user->getPhoneNumber()?>" autocomplete="off">

                    <?php
                    if(isset($messeges)){
                        foreach ($messeges as $message){
                            echo "<p>".$message."</p>";
                        }
                    }
                    ?>
                    <button id="button1" type="submit"> APPLY CHANGES </button>
                </div>
                </form>

                <div class="header1">GALLERY</div>

                <div><?php
                    include_once 'app/php/controllers/CompetitionController.php';
                    $competitionController = new CompetitionController();
                    $competitionController->displayCompetitionImagesGallery();
                    ?></div>

            </div>


    </div>


    <script>
        function maskInput(input) {
            let inputValue = input.value;
            let maskedValue = inputValue.replace(/./g, '*');
            input.value = maskedValue;
        }
    </script>
</body>