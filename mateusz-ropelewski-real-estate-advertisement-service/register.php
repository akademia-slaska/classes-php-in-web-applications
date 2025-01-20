<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <?php include('navbar.php'); ?>
    <main class="hero">
        <h2>Rejestracja</h2>
        <form action="register.php" method="POST">
            <input type="text" name="imie" placeholder="Imię" required></br>
            <input type="text" name="nazwisko" placeholder="Nazwisko" required></br>
            <input type="email" name="email" placeholder="Email" required></br>
            <input type="text" name="telefon" placeholder="Numer telefonu" required></br>
            <input type="password" name="haslo" placeholder="Hasło" required></br>
            <input type="password" name="haslo_confirm" placeholder="Powtórz hasło" required></br>
            <button type="submit" name="register" class="registerbutton">Zarejestruj się</button>
        </form>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 ZamieszkajTu. Wszystkie prawa zastrzeżone.</p>
        </div>
    </footer>
</div>

<?php
if (isset($_POST['register'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $haslo = password_hash($_POST['haslo'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (imie, nazwisko, email, telefon, haslo) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$imie, $nazwisko, $email, $telefon, $haslo]);

    header("Location: login.php");
}
?>
</body>
</html>

