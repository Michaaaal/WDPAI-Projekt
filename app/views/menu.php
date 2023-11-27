<head>
    <title>  </title>
    <link rel="stylesheet" type="text/css" href="app\css\menuStyle.css">
</head>

<body>
    <div class="menuContainer">
        <div class="menu">

            <button name="rating" id="evaluateButton" onclick ="window.location.href='/evaluate'" >
                <div class="menuImg">
                    <img src="app/img/star.svg">
                </div>
                <div class="menuText">
                    Evaluate
                </div>
            </button>

            <button name="laderboard" id="leaderboardButton" onclick ="window.location.href='/leaderboard'" >
                <div class="menuImg">
                    <img src="app/img/leaderboard.svg">
                </div>
                <div class="menuText">
                    Leaderboard
                </div>
            </button>

            <button name="profile" id="accButton" onclick ="window.location.href='/acc'">
                <div class="menuImg">
                    <img src="app/img/acc.svg">
                </div>
                <div class="menuText">
                    Post/Account
                </div>
            </button>
        </div>

    </div>


    <script>
        // Twój skrypt JavaScript
        var currentUrl = window.location.href.toLowerCase();
      
        if (currentUrl.includes('evaluate')) {
          document.getElementById('evaluateButton').classList.add('active');
        }

        if (currentUrl.includes('leaderboard')) {
          document.getElementById('leaderboardButton').classList.add('active');
        }

        if (currentUrl.includes('acc') || currentUrl.includes('add')) {
          document.getElementById('accButton').classList.add('active');
        }
      </script>
</body>