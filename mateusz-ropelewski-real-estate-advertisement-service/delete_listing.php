<?php
include('db.php');
include('init.php');

if (!isset($_SESSION['user_id']) || !isset($_POST['delete_listing'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_POST['id'];
$stmt = $pdo->prepare("DELETE FROM ogloszenia WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);

header("Location: dashboard.php");
exit();
?>

