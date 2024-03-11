<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBPROG</title>
    <link rel="stylesheet" type="text/css" href="Assets/css/skills.css">
    <link rel="stylesheet" type="text/css" href="Assets/css/style(intro).css">
    <link rel="stylesheet" type="text/css" href="Assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <header>
        <div class="title">
            <h1>Skills</h1>
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

</div>
<div class="box1 box"></div>
<div class="box2 box"></div>
<div class="box3 box"></div>
<div class="box4 box"></div>
<div class="box5 box"></div>
</div>

    <div class="wrap" data-aos="fade-right" class="skillText">
        <div class="interest" data-aos="fade-right" data-aos-anchor=".skillText">
            <h3>Interest:</h3>
            <div>
                <p>Web Development</p>
                <p>Designing</p>
                <p>Programming</p>
                <br>
                <p>I am willing to learn and explore possibilities in life and technology, who has great listening abilities and who learns quickly.</p>
            </div>
        </div>

        <div class="skillIteams" data-aos="fade-left">
            <div class="iteam iteam3">
                <div class="iteamCircle">
                    <img src="Assets/images/javascript.svg" alt="JavaScript">
                </div>
                <p>JavaScript</p>
            </div>
            <div class="iteam iteam4">
                <div class="iteamCircle">
                    <img src="Assets/images/html5.svg" alt="HTML5">
                </div>
                <p>HTML</p>
            </div>
            <div class="iteam iteam5">
                <div class="iteamCircle">
                    <img src="Assets/images/css3.svg" alt="CSS3">
                </div>
                <p>CSS</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
