<?php
require_once '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Неавторизованный доступ']);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['message']) && !empty(trim($_POST['message']))) {
        $message = trim($_POST['message']);
        $sender_id = $_SESSION['user_id'];

        try {
         
            $pdo = new PDO('mysql:host=localhost;dbname=chat_app', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          
            $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)");
            $stmt->execute([
                'sender_id' => $sender_id,
                'receiver_id' => 0, 
                'message' => $message
            ]);

          
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
         
            echo json_encode(['error' => 'Error with saving message: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Message cannot be empty']);
    }
}
