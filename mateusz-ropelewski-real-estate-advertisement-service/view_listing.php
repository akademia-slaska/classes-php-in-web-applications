<?php
include('db.php');
include('init.php');;

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM ogloszenia JOIN users ON ogloszenia.user_id = users.id WHERE ogloszenia.id = ?");
$stmt->execute([$id]);
$ogloszenie = $stmt->fetch();

if (!$ogloszenie) {
    echo "Ogłoszenie nie istnieje.";
    exit();
}

// Pobranie wszystkich zdjęć
$stmtZdjecia = $pdo->prepare("SELECT url FROM zdjecia WHERE ogloszenie_id = ?");
$stmtZdjecia->execute([$id]);
$zdjecia = $stmtZdjecia->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($ogloszenie['tytul']); ?></title>
</head>
<body>
<div class="wrapper">
    <?php include('navbar.php'); ?>
    <h2><?php echo htmlspecialchars($ogloszenie['tytul']); ?></h2>
    <div>
        <?php foreach ($zdjecia as $zdjecie): ?>
            <img src="<?php echo $zdjecie['url']; ?>" alt="Zdjęcie" style="width:400px;">
        <?php endforeach; ?>
    </div>
    <p>Opis: <?php echo htmlspecialchars($ogloszenie['opis']); ?></p>
    <p>Cena: <?php echo number_format($ogloszenie['cena'], 2); ?> PLN</p>
    <p>Adres: <?php echo htmlspecialchars($ogloszenie['adres']); ?></p>
    <p>Miasto: <?php echo htmlspecialchars($ogloszenie['miasto']); ?></p>
    <p>Kontakt: <?php echo htmlspecialchars($ogloszenie['telefon']); ?></p>
</div>
<footer>
    <div class="container">
        <p>&copy; 2024 ZamieszkajTu. Wszystkie prawa zastrzeżone.</p>
    </div>
</footer>
</body>
</html>

