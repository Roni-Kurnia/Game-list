<?php 
session_start();
require 'functions.php';

if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");

    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if(isset($_POST["regis"])) {
    header("Location: registrasi.php");
    exit;
}

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username'");
    
    if(empty($username || $password)){
        echo "<script> alert(' ada kolom yang belum diisi');</script>";
        exit;      
    }  

    // menegecek pengembalian nilai baris
    if (mysqli_num_rows($result) > 0 ) {

        // cek password 
        $row = mysqli_fetch_assoc($result);

        // decode password(membandingkan string)
        if(password_verify($password, $row["password"])) {
            // membuat session
            $_SESSION["login"] = true;

            // cek remember me
            if(isset($_POST["remember"])) {
                // cek cookie
                setcookie('id', $row['id'], time() + 25);
                setcookie('key', hash('sha256',$row['username']), time() + 25);
            }

            // redirec ke index
            header("Location: index.php");
            exit;
        }
    } 
    $error = true;   
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
        <h1>🎮 Selamat Datang</h1>
        <?php if(isset($error)): ?>
            <p class="error-message">❌ Username atau password salah</p>
        <?php endif ?>
        
        <form action="" method="post">
            <ul>
                <li>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" >
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" >
                </li>
                <li class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" style="margin-bottom: 0;">Remember Me</label>
                </li>
                <li class="button-group">
                    <button type="submit" name="login">Login</button>
                    <button type="submit" name="regis" style="background: #4CAF50;">Registrasi</button>
                </li>
            </ul>
        </form>
    </div>
</body>
</html>