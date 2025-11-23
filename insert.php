<?php 
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["batal"])) {
    header("Location: index.php");
    exit;
}

require "functions.php";

// cek apakah tombol sudah dieksekusi dan mengambil semua data dan memasukannya ke function tambah
if(isset($_POST["submit"]) ) {
    // jika nilai pengembalian lebih dari 0 maka akan mengubah data dan mengikrimkan konfirmasi
    if(tambah($_POST) > 0) {
        echo "<script> alert('data berhasil ditambahkan');  document.location.href = 'index.php'; </script>";
    } else {
        echo "<script> alert('data gagal ditambahkan');  document.location.href = 'index.php'; </script>";
    }
};
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
    <h1>Tamabahkan data</h1>
    <div class="container form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <ul>
                <li>
                    <label for="judul">Judul: </label>
                    <input type="text" name="judul" id="judul" >
                </li>
                <li>
                    <label for="genre">Genre: </label>
                    <input type="text" name="genre" id="genre" >
                </li>
                <li>
                    <label for="tersedia">Tersedia: </label>
                    <input type="text" name="tersedia" id="tersedia" >
                </li>
                <li>
                    <label for="developer">Developer: </label>
                    <input type="text" name="developer" id="developer" >
                </li>
                <li>
                    <label for="poster">Poster: </label>
                    <input type="file" name="poster" id="poster">
                </li>
                <li>
                    <button type="submit" name="submit">Kirim</button>
                    <button type="submit" name="batal">batal</button>
                </li>
            </ul>
        </form>
    </div>
</body>
</html>