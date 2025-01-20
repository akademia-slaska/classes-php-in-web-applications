<?php
session_start();
session_unset(); // Usunięcie wszystkich zmiennych sesji
session_destroy(); // Zniszczenie sesji

// Przekierowanie na stronę główną po wylogowaniu
header("Location: index.php");
exit();
?>

