<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Logowanie</h2>
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<p class="error-message">Błędny login lub hasło. Spróbuj ponownie.</p>';
        }
        ?>
        <form action="login.php" method="post">
            <label for="username">Login:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Zaloguj się">
        </form>
    </div>
</body>
</html>
