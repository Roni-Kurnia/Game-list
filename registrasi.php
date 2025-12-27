<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if(isset($_POST["in"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script> alert('registrasi sukses');  document.location.href = 'login.php';</script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="auth-container">
        <h1>Registrasi</h1>
        <form action="" method="post">
        <ul>
            <li>
                <label name="username"; for="username">Username</label>
                <input type="text"; name="username"; id="username";>
            </li>
            <li>
                <label name="password"; for="password">Password</label>
                <input type="password"; name="password"; id="password";>
            </li>
            <li>
                <label name="password2"; for="password2">Konfirmasi Password</label>
                <input type="password"; name="password2"; id="password2";>
            </li>
            <li class="button-group">
                <button type="submit" name="register">Register</button>
                <button type="submit" name="in" style="background: #4CAF50;">login</button>
            </li>
        </ul>
        </form>
    </div>
</body>
</html>