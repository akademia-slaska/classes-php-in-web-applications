<?php
session_start();
include 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

if (isset($_GET['sklep'])) {
    $id_sklepu = $_GET['sklep'];

    // Pobranie nazwy sklepu
    $sql_sklep = "SELECT nazwa_sklepu FROM sklep WHERE id_sklepu = ?";
    $stmt_sklep = $conn->prepare($sql_sklep);
    $stmt_sklep->bind_param("i", $id_sklepu);
    $stmt_sklep->execute();
    $result_sklep = $stmt_sklep->get_result();
    $sklep = $result_sklep->fetch_assoc();
    $nazwa_sklepu = $sklep['nazwa_sklepu'];

    // Pobranie ubrań
    $sql = "SELECT id_ubrania, nazwa_ubrania, cena FROM ubrania WHERE id_sklepu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_sklepu);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    header('Location: sklepy.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Ubrania</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="table-container">
        <h2>Ubrania w sklepie: <?php echo htmlspecialchars($nazwa_sklepu); ?></h2>
        <table>
            <tr>
                <th>Nazwa Ubrania</th>
                <th>Cena</th>
                <th>Akcje</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["nazwa_ubrania"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["cena"]) . "</td>";
                    echo "<td><a href='usun.php?id=" . $row["id_ubrania"] . "&sklep=" . $id_sklepu . "' class='delete-button' onclick='return confirm(\"Czy na pewno chcesz usunąć to ubranie?\")'>Usuń</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Brak ubrań w tym sklepie</td></tr>";
            }
            ?>
        </table>
        <a href="dodaj.php?sklep=<?php echo $id_sklepu; ?>" class="add-button">Dodaj ubranie</a>
        <a href="sklepy.php" class="back-button">Powrót</a>
    </div>
</body>
</html>

<?php
$stmt_sklep->close();
$stmt->close();
$conn->close();
?>
