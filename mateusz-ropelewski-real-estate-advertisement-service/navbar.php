<?php
include('init.php');
?>
<nav class="navbar">
    <div class="container">
        <a href="index.php" class="logo">ZamieszkajTu</a>
        <ul class="nav-links">
            <li><a href="mieszkania.php">Mieszkania</a></li>
            <li><a href="dzialki.php">Działki</a></li>
            <li><a href="domy.php">Domy</a></li>
            <?php if (isset($_SESSION['imie'])): ?>
                <ul class="panel">
                    <li><a href="dashboard.php">Mój Profil (<?php echo htmlspecialchars($_SESSION['imie']); ?>)</li>
                    <li><a href="logout.php">Wyloguj się</a></li>
                </ul>
            <?php else: ?>
                <li><a href="register.php">Rejestracja</a></li>
                <li><a href="login.php">Logowanie</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>


