<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="Assets/css/style(intro).css">
    <link rel="stylesheet" type="text/css" href="Assets/css/style(profile).css">
    <link rel="stylesheet" type="text/css" href="Assets/css/contact.css">
    <link rel="stylesheet" type="text/css" href="Assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<header>
    <div class="title">
        <h1>Contact</h1>
        <hr>
    </div>
    <nav>
        <ul>
            <li><button class="btn" onclick="window.location.href='index.php';">HOME</button></li>
            <li><button class="btn" onclick="window.location.href='skills.php';">SKILLS</button></li>
            <li><button class="btn" onclick="window.location.href='profile.php';">PROFILE</button></li>
            <li><button class="btn" onclick="window.location.href='contact.php';">CONTACT</button></li>
            <?php
            if (isset($_SESSION["user"]) && $_SESSION["user"] == "yes") {
                // User is logged in, show the logout button
                echo '<li><button class="btn" onclick="window.location.href=\'logout.php\';">LOGOUT</button></li>';
            } else {
                // User is not logged in, show the login button
                echo '<li><button class="btn" onclick="window.location.href=\'login.php\';">LOGIN</button></li>';
            }
            ?>
        </ul>
    </nav>
</header>

<div class="center">
    <div class="box1 box"></div>
    <div class="box2 box"></div>
    <div class="box3 box"></div>
    <div class="box4 box"></div>
    <div class="box5 box"></div>
</div>
    
<div class="links center">
    <h2>You can find me on the internet here:</h2>
    <ul>
        <li><a href="https://outlook.office.com/mail/sentitems?actSwt=true" target="_blank"><i class="fa fa-envelope"></i> Mail</a></li>
        <li><a href="https://www.facebook.com/NEILANDREIENRERA" target="_blank"><i class="fab fa-facebook"></i> Facebook</a></li>
        <li><a href="https://www.linkedin.com/in/neil-andrei-enrera-2845b5252/" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
        <li><a href="https://github.com/NeilEnrera" target="_blank"><i class="fab fa-github"></i> Github</a></li>
    </ul>
</div>

</body>
</html>
