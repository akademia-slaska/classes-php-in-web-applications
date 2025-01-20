<?php
include('db.php');
include('init.php');

$typ = 'Działka';
$stmt = $pdo->prepare("SELECT * FROM ogloszenia WHERE typ = ?");
$stmt->execute([$typ]);
$ogloszenia = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista działek</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="wrapper">
    <?php include('navbar.php'); ?>
    <main class="hero">
        <h2>Lista działek:</h2>
        <?php foreach ($ogloszenia as $ogloszenie): ?>
            <div>
                <?php
                // Pobranie pierwszego zdjęcia
                $stmtImg = $pdo->prepare("SELECT url FROM zdjecia WHERE ogloszenie_id = ? LIMIT 1");
                $stmtImg->execute([$ogloszenie['id']]);
                $zdjecie = $stmtImg->fetch();
                ?>
                <img src="<?php echo $zdjecie['url']; ?>" alt="Zdjęcie nieruchomości" style="width:100px;">
                <h3><?php echo htmlspecialchars($ogloszenie['tytul']); ?></h3>
                <p>Cena: <?php echo number_format($ogloszenie['cena'], 2); ?> PLN</p>
                <a href="view_listing.php?id=<?php echo $ogloszenie['id']; ?>" class="btn">Zobacz ofertę</a>
            </div>
<?php endforeach; ?>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 ZamieszkajTu. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>
</div>
</body>
</html>

