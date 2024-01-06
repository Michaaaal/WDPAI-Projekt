<!DOCTYPE html>
<head>
    <title> Login </title>
    <link rel="stylesheet" type="text/css" href="app/css/styleLogin.css">
</head>

<body>
    <div class="container">
        
        <div class="logo" > 
            <img id="logoImg" src="app/img/logo.svg">
        </div>

        <div class="login_container"> 
            <form class="login" action="login" method="POST">

                <div class='messages'>
                    <?php
                    if(isset($messeges)){
                        foreach ($messeges as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>

                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button id="button1" type="submit"> CONTINUE </button>
            </form>
                <button id="button2" onclick ="window.location.href='/register'" > REGISTER </button>
        </div>

    </div>
</body>