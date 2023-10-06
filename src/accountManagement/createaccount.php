<?php

if (empty($_POST["username"])) {
    die("Username is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 9) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["passwordConfirm"]) {
    die("Passwords must match");
}


$hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);


$mysqli = require __DIR__ . "/database.php";

$username = $_POST["username"];

$email = $_POST["email"];


$stmt = $mysqli->prepare("INSERT INTO users (username, email, hashed_password) VALUES (?, ?, ?)");

$stmt->bind_param("sss", $username, $email, $hashedPassword);
                  
if ($stmt->execute()) {  

  header("Location: signupsucsess.html");

  var_dump($hashedPassword);
  exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}


