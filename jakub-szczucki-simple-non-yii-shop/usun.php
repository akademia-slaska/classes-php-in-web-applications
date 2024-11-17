<?php
session_start();
include 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

if (isset($_GET['id']) && isset($_GET['sklep'])) {
    $id_ubrania = $_GET['id'];
    $id_sklepu = $_GET['sklep'];

    $sql = "DELETE FROM ubrania WHERE id_ubrania = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_ubrania);
    $stmt->execute();

    header("Location: ubrania.php?sklep=$id_sklepu");
    exit;
} else {
    header('Location: sklepy.php');
    exit;
}
?>
