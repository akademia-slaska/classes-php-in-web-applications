<?php
header('Content-Type: application/json');

require 'db_connection.php'; // Załóżmy, że masz plik db_connection.php z połączeniem do bazy

$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['userId'];
$status = $data['status'];

$stmt = $pdo->prepare("UPDATE users SET status = :status WHERE id = :userId");
$stmt->bindParam(':status', $status);
$stmt->bindParam(':userId', $userId);
$stmt->execute();

echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
?>
