<?php
    $hostName = "sql208.infinityfree.com";
    $dbUser = "if0_36136915";
    $dbPassword = "i4pymkKwwoyZIoi";
    $dbName = "if0_36136915_enreralogreg";
    $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
    if(!$conn){
        die("Something went wrong!");
    }

?>