<?php include('db.php'); session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <?php include('navbar.php'); ?>
    <main class="hero">
        <h2>Logowanie</h2>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required><br/></br>
            <input type="password" name="haslo" placeholder="Hasło" required></br></br>
            <button type="submit" name="login" class="loginbutton">Zaloguj się</button>
        </form>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 ZamieszkajTu. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>
</div>

<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $haslo = $_POST['haslo'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($haslo, $user['haslo'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['imie'] = $user['imie'];
        header("Location: dashboard.php");
    } else {
        echo "Błędny email lub hasło.";
    }
}
?>
</body>
</html>

