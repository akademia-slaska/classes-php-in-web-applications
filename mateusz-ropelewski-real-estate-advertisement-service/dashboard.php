<?php include('db.php'); session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Panel Użytkownika</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <?php include('navbar.php');?>
    <main class="dashboard">
        <div class="left-panel">
            <h2>Panel Użytkownika</h2>
            <a href="add_listing.php">Dodaj ogłoszenie</a>
        </div>

        <div class="right-panel">
            <h2>Moje ogłoszenia</h2>
            <?php
            include('db.php');

            if (!isset($_SESSION['user_id'])) {
                header("Location: login.php");
                exit();
            }

            $user_id = $_SESSION['user_id'];
            $stmt = $pdo->prepare("SELECT * FROM ogloszenia WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $ogloszenia = $stmt->fetchAll();
            ?>


            <?php foreach ($ogloszenia as $ogloszenie): ?>
                <div>
                    <h3><?php echo htmlspecialchars($ogloszenie['tytul']); ?></h3>
                    <p>Cena: <?php echo number_format($ogloszenie['cena'], 2); ?> PLN</p>
                    <a href="edit_listing.php?id=<?php echo $ogloszenie['id']; ?>">Edytuj</a>
                    <form action="delete_listing.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $ogloszenie['id']; ?>">
                        <button type="submit" name="delete_listing">Usuń</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>


</div>
<footer>
    <div class="container">
        <p>&copy; 2024 ZamieszkajTu. Wszystkie prawa zastrzeżone.</p>
    </div>
</footer>
</body>
</html>

