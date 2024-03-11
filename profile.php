<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
    <link rel="stylesheet" type="text/css" href="Assets/css/style(intro).css">
    <link rel="stylesheet" type="text/css" href="Assets/css/style(profile).css">
    <link rel="stylesheet" type="text/css" href="Assets/css/contact.css">
    <link rel="stylesheet" type="text/css" href="Assets/css/home.css">
<body>

  <header>
    <div class="title">
        <h1>Profile</h1>
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

  <div class="profile-container">
    <header>
      <h1>Profile</h1>
    </header>
    <div class="centered">
      <img src="Assets/images/neil.jpg" alt="Neil">
    </div>
    <section class="info-section">
      <h2>About Me</h2>
      <p><strong>Name:</strong> Enrera, Neil Andrei </p>
      <p><strong>Birthday:</strong> September 24</p>
      <p><strong>Course:</strong> IT 2nd Year - 2023</p>
      <p><strong>School:</strong> National University (NU)</p>
      <p><strong>Address:</strong> San Jose del Monte, Bulacan</p>
    </section>
    <section class="education-section">
      <h2>Education</h2>
      <p><strong>Current:</strong> Bachelor of Science in Information Technology (BSIT), National University</p>
    </section>
    <section class="skills-section">
      <h2>Skills</h2>
      <p><strong>Programming:</strong> Java, Python</p>
      <p><strong>Web Development:</strong> HTML, CSS, JavaScript</p>
      <p><strong>Other Skills:</strong> Responsible, Teamwork, Communication</p>
    </section>
    <section class="contact-section">
      <h2>Contact</h2>
      <p><strong>LinkedIn:</strong> <a href="https://www.linkedin.com/in/neil-andrei-enrera-2845b5252/" target="_blank">Neil Andrei Enrera</a></p>
      <p><strong>Github:</strong> <a href="https://github.com/NeilEnrera?tab=overview&from=2023-12-01&to=2023-12-31" target="_blank">Enrera, Neil Andreis</a></p>
      <p><strong>Email:</strong> enreranm@students.nu-fairview.edu.ph</p>
      <p><strong>Phone Number:</strong> 0915-974-****</p>
    </section>
  </div>

  </div>
              <div class="box1 box"></div>
              <div class="box2 box"></div>
              <div class="box3 box"></div>
              <div class="box4 box"></div>
              <div class="box5 box"></div>
          </div>

</body>
</html>
