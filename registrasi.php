<?php
session_start();

if (!isset($_SESSION["login"])) {
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
    <style>
        body{
            font-size: 18px;
        }
        .container {
            width: 400px;
        }
        .penanda {
            width: 200px;
            float: left;
        }
        .penanda, label{
            display: block;
        }
        .masukan  {
            width: 190px;
        }
        .masukan, input {
            float: right;
            padding: 1.5px;
        }
        .tombol {
            padding-top: 71px;  
            left: 0;
        }
    </style>
</head>
<body>
    <h1>Halaman Registrasi</h1>
    <form action="" method="post">
        <div class="container">
            <div class="penanda">
                <label name="username"; for="username">Username</label>
                <label name="password"; for="password">Password</label>
                <label name="password2"; for="password2">Konfirmasi Password</label>
            </div>
            <div class="masukan">
                <input type="text"; name="username"; id="username";>
                <input type="password"; name="password"; id="password";>
                <input type="password"; name="password2"; id="password2";>
            </div>
            <div class="tombol">
                <button type="submit" name="register">Register</button>
                <button type="submit" name="in">login</button>
            </div>
        </div>
    </form>
</body>
</html>