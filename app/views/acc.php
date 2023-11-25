<!DOCTYPE html>
<head>
    <title> Post/Account </title>
    <link rel="stylesheet" type="text/css" href="app/css/background.css">
    <link rel="stylesheet" type="text/css" href="app/css/accStyle.css">
</head>

<body>
    <?php include 'app/views/menu.php' ?>
    
    <div class="container">


        <section class="addCPform">
            <div class="addCompetitionPhoto">

                <form action="addCP" method="POST" ENCTYPE="multipart/form-data">
                    <?php
                    if(isset($messeges)){
                        foreach ($messeges as $message){
                            echo $message;
                        }
                    }
                    ?>

                    <div><input type="file" name="file"></div>

                    <div><textarea  name="description" rows="5" placeholder="DESC"></textarea></div>

                    <div><button type="submit">post</button></div>
                </form>

                <div>
                    UPLOADED
                </div>

                <div>
                   <?php if ($competitionPhoto != null) {
                    $description = $competitionPhoto->getDescription();
                    if (!empty($description)) {
                    echo $description;
                    }
                    } ?>
                </div>

                <div>
                    <img class="uploadedIMG" src="app/iuploadsTMP/<?=
                        $competitionPhoto->getImage();
                    ?>">
                </div>

            </div>
        </section>





        <section class="account">
            <div class="accountCont">
                ACC
            </div>
        </section>

    </div>
</body>