<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="pl" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZamieszkajTu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <?php include('navbar.php');?>
    <main class="hero">
        <div class="container">
            <h1>Witamy w ZamieszkajTu!</h1>
            <p>Znajdź swoje wymarzone miejsce na ziemi</p>
            <a href="mieszkania.php" class="btn">Zobacz mieszkania</a></br>
            <a href="domy.php" class="btn">Zobacz domy</a></br>
            <a href="dzialki.php" class="btn">Zobacz działki</a>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 ZamieszkajTu. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>
</div>
<script src="js/script.js"></script>
</body>
</html>
