<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="app/css/styleTopic.css">
</head>
<body>
    <div class="topicContainer">
        <div class="rainbow"> Topic:&nbsp;</div>
        <div class="topicName" ><?php $topicId = $_SESSION['topicName'];echo $topicId
            ;$endDate = $_SESSION['topicEndDate'];echo " | ends ".$endDate;?></div>

        <form action="/logout" method="post">
            <div class="logout"><input type="submit" value="Logout"></div>
        </form>
    </div>
</body>
</html>