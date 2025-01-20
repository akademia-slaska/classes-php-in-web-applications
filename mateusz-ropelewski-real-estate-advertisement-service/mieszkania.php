<?php
include('db.php');
include('init.php');

$typ = 'Mieszkanie';
$stmt = $pdo->prepare("SELECT * FROM ogloszenia WHERE typ = ?");
$stmt->execute([$typ]);
$ogloszenia = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista mieszkań</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <?php include('navbar.php'); ?>
    <main class="hero">
        <h2>Lista mieszkań</h2>
        <?php foreach ($ogloszenia as $ogloszenie): ?>
            <div>
                <?php
                // Pobranie pierwszego zdjęcia dla danego ogłoszenia
                $stmtImg = $pdo->prepare("SELECT url FROM zdjecia WHERE ogloszenie_id = ? LIMIT 1");
                $stmtImg->execute([$ogloszenie['id']]);
                $zdjecie = $stmtImg->fetch();

                // Sprawdzenie, czy zdjęcie istnieje
                if ($zdjecie && $zdjecie['url']) {
                    $imgSrc = htmlspecialchars($zdjecie['url']);
                } else {
                    // Domyślne zdjęcie, jeśli brak zdjęć w bazie
                    $imgSrc = 'images/no-image.jpg'; // Upewnij się, że taki plik istnieje w folderze `images`
                }
                ?>
                <img src="<?php echo $imgSrc; ?>" alt="Zdjęcie nieruchomości" style="width:200px;">
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
