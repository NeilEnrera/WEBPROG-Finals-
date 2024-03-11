<?php
session_start();
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    require_once "database.php";
    $sql = "SELECT * FROM registration WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if (password_verify($password, $user["user_password"])) {
            // Store user information in session
            $_SESSION["user"] = "yes";
            $_SESSION["first_name"] = $user["USER_FNAME"];
            header("Location: index.php");
            die();
        } else {
            echo "<div class='alert alert-danger'> Password does not match! </div>";
        }
    } else {
        echo "<div class='alert alert-danger'> Email does not match </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="Assets/css/login.css?v=<?php echo time(); ?>">
</head>

<body>

    <div class="container">
        <div class="form-container">
            <div class="box">
                <div class="form-content">
                    <form action="login.php" class="signin-form" method="post">
                        <div class="form-group">
                            <div class="animate-input">
                                <span for="email">Email</span>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="animate-input">
                                <span for="password">Password</span>
                                <input type="password" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button class="btn-login" type="submit" name="login">Log In</button>
                        </div>
                        <div class="divine">
                            <div></div>
                            <div>or</div>
                            <div></div>
                        </div>
                    </form>
                </div>
                <div class="goto">
                    <p>
                        Don't have an account?
                        <a href="registration.php">Register here.</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
