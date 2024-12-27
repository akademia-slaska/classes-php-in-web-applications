<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles.css">
    <title>Chat</title>
</head>
<body>
    <div class="chat-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        
        <div id="chat-box">
           
        </div>
        
        <form id="chat-form">
            <input type="text" id="message" placeholder="Enter the message" required>
            <button type="submit">Send</button>
        </form>
    </div>
    
    <script src="./assets/script.js"></script>
</body>
</html>
