<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles.css">
    <title>Sign in</title>
</head>
<body>
    <div class="container ">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Sign in</button>
        </form>
        <p>Already have an account?<a href="login.php">Log In</a></p>
    </div>
</body>
</html>
<?php

require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    if ($stmt->rowCount() > 0) {
        echo "<p class= 'error' style='color: red;'>This name already used.</p>";
    } else {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute([
            'username' => $username,
            'password' => $hashedPassword
        ]);

        echo "<p class= 'error' style='color: green;'>Success register! You can <a href='login.php'>log in</a>.</p>";
    }
}
?>
