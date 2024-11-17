<?php
session_start();
include 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

if (isset($_GET['sklep'])) {
    $id_sklepu = $_GET['sklep'];
} else {
    header('Location: sklepy.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nazwa_ubrania = $_POST['nazwa_ubrania'];
    $cena = $_POST['cena'];

    $sql = "INSERT INTO ubrania (nazwa_ubrania, cena, id_sklepu) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $nazwa_ubrania, $cena, $id_sklepu);
    $stmt->execute();

    header("Location: ubrania.php?sklep=$id_sklepu");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj Ubranie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Dodaj Ubranie</h2>
        <form action="dodaj.php?sklep=<?php echo $id_sklepu; ?>" method="post">
            <label for="nazwa_ubrania">Nazwa Ubrania:</label>
            <input type="text" id="nazwa_ubrania" name="nazwa_ubrania" required><br><br>
            <label for="cena">Cena:</label>
            <input type="number" id="cena" name="cena" step="0.01" required><br><br>
            <input type="submit" value="Dodaj">
        </form>
        <a href="ubrania.php?sklep=<?php echo $id_sklepu; ?>" class="back-button">Powrót</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
