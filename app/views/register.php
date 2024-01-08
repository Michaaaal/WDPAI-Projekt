<!DOCTYPE html>
<head>
    <title> Registration </title>
    <link rel="stylesheet" type="text/css" href="app/css/styleLogin.css">
</head>

<body>
    <div class="container">
        <div class="login_container">
            <form action="registerUser" method="post" >
                <div class='messages'>
                    <?php
                    if(isset($messeges)){
                        foreach ($messeges as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="e-mail" type="text" placeholder="e-mail" autocomplete="off">
                <input name="firstPassword" type="password" placeholder="password" autocomplete="off">
                <input name="secondPassword" type="password" placeholder="repeat password" autocomplete="off">
                <input name="nickname" type="text" placeholder="Nickname" autocomplete="off">
                <input name="phone-number" type="text" placeholder="Phone number" autocomplete="off">

                <button id="button1" type="submit" > REGISTER </button>
            </form>
        </div>

    </div>
</body>