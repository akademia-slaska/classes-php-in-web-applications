<?php
include('db.php');
include('init.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $listing_id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM ogloszenia WHERE id = ? AND user_id = ?");
    $stmt->execute([$listing_id, $_SESSION['user_id']]);
    $ogloszenie = $stmt->fetch();

    if (!$ogloszenie) {
        echo "Ogłoszenie nie istnieje lub nie masz do niego dostępu.";
        exit();
    }
} else {
    echo "Brak ID ogłoszenia.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tytul = $_POST['tytul'];
    $typ = $_POST['typ'];
    $opis = $_POST['opis'];
    $adres = $_POST['adres'];
    $miasto = $_POST['miasto'];
    $cena = $_POST['cena'];

    $stmt = $pdo->prepare("UPDATE ogloszenia SET tytul = ?, typ = ?, opis = ?, adres = ?, miasto = ?, cena = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$tytul, $typ, $opis, $adres, $miasto, $cena, $listing_id, $_SESSION['user_id']]);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj ogłoszenie</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <?php include('navbar.php'); ?>

    <h2 style="display: flex; color: #a5b44f; justify-content: center">Edytuj ogłoszenie</h2>

    <form action="edit_listing.php?id=<?php echo $ogloszenie['id']; ?>" method="POST">
        <h3>Podaj tytuł ogłoszenia:</h3>
        <input type="text" name="tytul" placeholder="Tytuł ogłoszenia" size="50" style="border: #a5b44f 7px solid" value="<?php echo htmlspecialchars($ogloszenie['tytul']); ?>" required><br>

        <h3>Wybierz typ nieruchomości:</h3>
        <select name="typ" size="1" style="width: 400px; border: #a5b44f 7px solid" required>
            <option value="Mieszkanie" <?php echo $ogloszenie['typ'] == 'Mieszkanie' ? 'selected' : ''; ?>>Mieszkanie</option>
            <option value="Dom" <?php echo $ogloszenie['typ'] == 'Dom' ? 'selected' : ''; ?>>Dom</option>
            <option value="Działka" <?php echo $ogloszenie['typ'] == 'Działka' ? 'selected' : ''; ?>>Działka</option>
        </select><br>

        <h3>Dodaj opis nieruchomości:</h3>
        <textarea name="opis" placeholder="Opis" cols="60" rows="10" style="border: #a5b44f 7px solid" required><?php echo htmlspecialchars($ogloszenie['opis']); ?></textarea><br>

        <h3>Podaj ulicę, numer domu, numer mieszkania:</h3>
        <input type="text" name="adres" placeholder="Adres" size="50" style="border: #a5b44f 7px solid" value="<?php echo htmlspecialchars($ogloszenie['adres']); ?>" required><br>

        <h3>Podaj miasto:</h3>
        <input type="text" name="miasto" placeholder="Miasto" size="50" style="border: #a5b44f 7px solid" value="<?php echo htmlspecialchars($ogloszenie['miasto']); ?>" required><br>

        <h3>Podaj cenę nieruchomości:</h3>
        <input type="number" name="cena" placeholder="Cena" size="200" style="border: #a5b44f 7px solid" value="<?php echo htmlspecialchars($ogloszenie['cena']); ?>" required><br>

        <button type="submit" style="color: #a5b44f; scale: 1.5 ;font-size: 22px; background-color: #007bff">Zapisz zmiany</button><br>
    </form>
</div>

<footer>
    <div class="container">
        <p>&copy; 2024 ZamieszkajTu. Wszystkie prawa zastrzeżone.</p>
    </div>
</footer>

</body>
</html>
