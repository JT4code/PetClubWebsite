<?php

if (empty($_POST["username"])) {
    die("Username is required");
}

if (empty($_POST["password"])) {
    die("Passwords is required");
}


$mysqli = require __DIR__ . "/database.php";

$sql = sprintf("SELECT * FROM users 
WHERE username = '%s'",
$mysqli->real_escape_string($_POST["username"]));

$result = $mysqli->query($sql);

$user = $result->fetch_assoc();

if ($user) {
        
    if (password_verify($_POST["password"], $user["hashed_password"])) {

        session_start();

        $_SESSION['username'] = $_POST["username"];
        $_SESSION['password'] = $user["hashed_password"];
        $_SESSION['loggedin'] = true;

        $location = "Location: /src/userRoot/" . $_POST["username"] . "/dashboard.php";

        header($location);

        #chmod("test.txt",0600);

        #chown("test.txt","charles");

        var_dump($user);
        exit;
    }
}

header("Location: loginfail.html");


var_dump($user);


#echo '<script type="text/javascript">
#           window.location = "http://www.google.com/"
#      </script>';
exit;