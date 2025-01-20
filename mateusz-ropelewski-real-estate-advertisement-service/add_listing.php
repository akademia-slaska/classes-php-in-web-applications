<?php
include('db.php');
include('init.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_listing'])) {
    $tytul = $_POST['tytul'];
    $typ = $_POST['typ'];
    $opis = $_POST['opis'];
    $adres = $_POST['adres'];
    $miasto = $_POST['miasto'];
    $cena = $_POST['cena'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO ogloszenia (tytul, typ, opis, adres, miasto, cena, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$tytul, $typ, $opis, $adres, $miasto, $cena, $user_id]);


    $ogloszenie_id = $pdo->lastInsertId();

    foreach ($_FILES['zdjecia']['tmp_name'] as $key => $tmp_name) {
        if ($key >= 5) break;
        if (!empty($tmp_name)) {
            $imgData = file_get_contents($tmp_name);

            // Tworzymy unikalną nazwę pliku
            $fileName = uniqid() . '.jpg';
            $uploadDir = 'uploads/';

            // Przesuwamy plik do folderu 'uploads/'
            move_uploaded_file($tmp_name, $uploadDir . $fileName);

            // Zapisujemy ścieżkę do pliku w bazie danych
            $stmt = $pdo->prepare("INSERT INTO zdjecia (ogloszenie_id, url) VALUES (?, ?)");
            $stmt->execute([$ogloszenie_id, $uploadDir . $fileName]);
        }
    }


    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj ogłoszenie</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="wrapper">
    <?php include('navbar.php');?>
    <h2 style="display: flex; color: #a5b44f; justify-content: center">Dodaj nowe ogłoszenie</h2>
    <form action="add_listing.php" method="POST" enctype="multipart/form-data">
        <h3>Podaj tytuł ogłoszenia:</h3>
        <input type="text" name="tytul" placeholder="Tytuł ogłoszenia" size="50" style="border: #a5b44f 7px solid" required></br>
        <h3>Wybierz typ nieruchomości:</h3>
        <select name="typ" size="1" style="width: 400px; border: #a5b44f 7px solid" required>
        <option value="Mieszkanie">Mieszkanie</option>
        <option value="Dom">Dom</option>
        <option value="Działka">Działka</option>
        </select></br>
        <h3>Dodaj opis nieruchomości:</h3>
        <textarea name="opis" placeholder="Opis" cols="60" rows="10" style="border: #a5b44f 7px solid" required></textarea></br>
        <h3>Podaj ulicę, numer domu, numer mieszkania:</h3>
        <input type="text" name="adres" placeholder="Adres" style="border: #a5b44f 7px solid;" size="50" required></br>
        <h3>Podaj miasto:</h3>
        <input type="text" name="miasto" placeholder="Miasto" size="50" style="border: #a5b44f 7px solid" required></br>
        <h3>Podaj cenę nieruchomości:</h3>
        <input type="number" name="cena" placeholder="Cena" size="200" style="border: #a5b44f 7px solid" required></br>
        <h3>Dodaj zdjęcia (max 5 zdjęć)</h3>
        <input type="file" name="zdjecia[]" multiple accept="image/*" style="border: #a5b44f 7px solid" required></br>
        <button type="submit" name="add_listing" style="color: #a5b44f; scale: 1.5 ;font-size: 22px; background-color: #007bff">Dodaj ogłoszenie</button></br>
    </form>
</div>
<footer>
    <div class="container">
        <p>&copy; 2024 ZamieszkajTu. Wszystkie prawa zastrzeżone.</p>
    </div>
</footer>
</body>
</html>

