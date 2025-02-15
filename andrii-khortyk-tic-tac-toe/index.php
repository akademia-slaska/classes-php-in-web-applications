<?php
session_start();

// Initialize game board if not set
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = array_fill(0, 9, '');
    $_SESSION['turn'] = 'X';  // X starts
    $_SESSION['winner'] = null;
}

// Handle player move
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cell'])) {
    $cell = (int)$_POST['cell'];

    if ($_SESSION['board'][$cell] === '' && $_SESSION['winner'] === null) {
        $_SESSION['board'][$cell] = $_SESSION['turn'];
        $_SESSION['turn'] = ($_SESSION['turn'] === 'X') ? 'O' : 'X';
    }

    // Check for winner
    checkWinner();
}

// Check for win conditions
function checkWinner() {
    $winningPatterns = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // Rows
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columns
        [0, 4, 8], [2, 4, 6]             // Diagonals
    ];

    foreach ($winningPatterns as $pattern) {
        if ($_SESSION['board'][$pattern[0]] !== '' &&
            $_SESSION['board'][$pattern[0]] === $_SESSION['board'][$pattern[1]] &&
            $_SESSION['board'][$pattern[1]] === $_SESSION['board'][$pattern[2]]) {
            $_SESSION['winner'] = $_SESSION['board'][$pattern[0]];
            return;
        }
    }

    // Check for a draw
    if (!in_array('', $_SESSION['board'])) {
        $_SESSION['winner'] = 'Draw';
    }
}

// Reset game
if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe - PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Tic Tac Toe</h1>

    <div class="game-board">
        <form method="POST">
            <?php foreach ($_SESSION['board'] as $index => $value): ?>
                <button type="submit" name="cell" value="<?= $index; ?>" class="cell"><?= $value; ?></button>
            <?php endforeach; ?>
        </form>
    </div>

    <div class="status">
        <?php
        if ($_SESSION['winner']) {
            echo $_SESSION['winner'] === 'Draw' ? "<p>It's a Draw!</p>" : "<p>Winner: {$_SESSION['winner']}</p>";
        } else {
            echo "<p>Current Turn: {$_SESSION['turn']}</p>";
        }
        ?>
    </div>

    <form method="POST">
        <button type="submit" name="reset" class="reset-btn">Restart Game</button>
    </form>

</body>
</html>
