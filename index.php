<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBPROG</title>
    <link rel="stylesheet" type="text/css" href="Assets/css/style(intro).css">
    <link rel="stylesheet" type="text/css" href="Assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <div class="title">
            <h1>Home</h1>
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

    <div class="container">
      <div class="leftcontent">
        <div class="innerblock highlight">
          <img src="Assets/images/Neil.png" alt="Neil">
        </div>
      </div>
      <div class="rightcontent">
        <div class="aboutMeContainer">
          <div class="aboutMe">
            <div class="home">
              <div class="content">
                  <h3>Hello, My name is</h3>
                  <div>
                      <h1>Enrera, Neil</h1>
                  </div>
                  <h2>I'm a <span class="role" data-wait="1000"
                          data-words='["Student","Web Developer.","Passionate Learner."]'
                          data-wait='1000'></span></h2>
              </div>
              <div class="box1 box"></div>
              <div class="box2 box"></div>
              <div class="box3 box"></div>
              <div class="box4 box"></div>
              <div class="box5 box"></div>
          </div>
          
    <footer>
        <div class="footer-left">
            <div class="links">
                <a href="https://www.facebook.com/yourname/"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.linkedin.com/in/yourname/"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://github.com/yourname"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </footer>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
  const roles = ["Student", "Web Developer.", "Passionate Learner."];
  const roleElement = document.querySelector(".role");
  let index = 0;
  
  function changeRole() {
      roleElement.textContent = roles[index];
      index = (index + 1) % roles.length;
  }
  
  setInterval(changeRole, 3000);
});
    </script>
    
</body>
</html>