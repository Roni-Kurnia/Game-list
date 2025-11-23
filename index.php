<?php
session_start();
require 'functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$games = query ("SELECT * FROM game");

if(isset($_POST["cari"])) {
    $games = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Game Favorit</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <div class="container">
        <a href="logout.php" class="button logout-btn">Logout</a>
        <h1>Daftar Game Favorit</h1>
        
        <a href="insert.php" class="button mb-20">➕ Tambah Data Game</a>
        
        <div class="search-container">
            <input type="text" name="keyword" id="keyword" placeholder="🔍 Cari game favorit Anda..." autocomplete="off">
            <button type="submit" name="cari" id="tombolCari">Cari</button>
            <img src="asset/loader.gif" class="loader">
        </div>
        
        <div id="container">
            <table>
                <tr>
                    <th>NO</th>
                    <th>Aksi</th>
                    <th>Poster</th>
                    <th>Judul</th>
                    <th>Genre</th>
                    <th>Tersedia</th>
                    <th>Developer</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach ($games as $game) : ?> 
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <a href="update.php?id=<?= $game["id"];?>">Edit</a>
                            <a href="delete.php?id=<?= $game["id"];?>" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                        </td>
                        <td><img src="asset/<?= $game["poster"] ?>" alt="_<?= $game["judul"] ?>" style="width: 100px; height: 100px;"></td>
                        <td><?= $game["judul"] ?></td>
                        <td><?= $game["genre"] ?></td>
                        <td><?= $game["tersedia"] ?></td>
                        <td><?= $game["developer"] ?></td>
                    </tr>
                <?php $i++; ?><?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>