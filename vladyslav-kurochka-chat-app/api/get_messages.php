<?php
require_once '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}


$stmt = $pdo->prepare("
    SELECT messages.id, messages.message, messages.created_at, users.username 
    FROM messages 
    JOIN users ON messages.sender_id = users.id 
    ORDER BY messages.created_at ASC
");
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($messages);
