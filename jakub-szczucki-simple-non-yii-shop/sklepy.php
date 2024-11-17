<?php
session_start();
include 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

$sql = "SELECT id_sklepu, nazwa_sklepu, lokalizacja FROM sklep";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wybór Sklepu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="store-selection-container">
        <h2>Wybierz sklep</h2>
        <div class="store-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='store-box'>";
                    echo "<h3>" . htmlspecialchars($row["nazwa_sklepu"]) . "</h3>";
                    echo "<p>Lokalizacja: " . htmlspecialchars($row["lokalizacja"]) . "</p>";
                    echo "<form action='ubrania.php' method='get'>";
                    echo "<input type='hidden' name='sklep' value='" . $row["id_sklepu"] . "'>";
                    echo "<input type='submit' value='Pokaż ubrania'>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>Brak sklepów do wyświetlenia</p>";
            }
            ?>
        </div>
        <a href="logout.php" class="logout-button">Wyloguj się</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
