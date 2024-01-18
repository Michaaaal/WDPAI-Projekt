<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<h1>Admin panel</h1>
<br>
<h2>Remove User by Nickname</h2>
<form method="post" action="removeUser">
    <?php
    if(isset($messeges)){
        foreach ($messeges as $message){
            echo $message;
        }
    }
    ?>
    <br>
    <input name="nickname" placeholder="enter user nick to ban"/>
    <br>
    <button type="submit">Enter</button>
</form>

</body>
</html>