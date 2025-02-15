<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Funkcja do stworzenia talii kart
function createDeck() {
    $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades']; // Kolory kart
    $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A']; // Wartości kart

    $deck = [];
    foreach ($suits as $suit) {
        foreach ($values as $value) {
            $deck[] = $value . ' of ' . $suit; // Dodaj kartę do talii
        }
    }
    shuffle($deck); // Tasowanie talii
    return $deck;
}

// Funkcja do obliczenia punktów ręki
function calculatePoints($hand) {
    $points = 0;
    $aces = 0; // Liczymy asy osobno

    foreach ($hand as $card) {
        $value = explode(' ', $card)[0]; // Pobieramy wartość karty
        if (in_array($value, ['J', 'Q', 'K'])) {
            $points += 10; // Figury mają 10 punktów
        } elseif ($value == 'A') {
            $points += 11; // As na razie daje 11 punktów
            $aces++;
        } else {
            $points += (int)$value; // Dodajemy wartość karty
        }
    }

    // Jeśli mamy asy i suma punktów przekracza 21, traktujemy asy jako 1 punkt
    while ($points > 21 && $aces > 0) {
        $points -= 10;
        $aces--;
    }

    return $points;
}

// Rozpoczynamy grę
if (!isset($_SESSION['deck'])) {
    $_SESSION['deck'] = createDeck(); // Tworzymy nową talię kart
    $_SESSION['playerHand'] = []; // Ręka gracza
    $_SESSION['dealerHand'] = []; // Ręka dealera
}

// Funkcja do rozpoczęcia nowej gry
function startNewGame() {
    $_SESSION['deck'] = createDeck();
    $_SESSION['playerHand'] = [];
    $_SESSION['dealerHand'] = [];
}

// Funkcja do dobierania karty
function drawCard($hand) {
    $card = array_pop($_SESSION['deck']); // Dobieramy kartę z talii
    $hand[] = $card; // Dodajemy kartę do ręki
    return $hand;
}

// Obsługa ruchów gracza i dealera
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'start') {
        startNewGame();
    } elseif ($_POST['action'] == 'hit') {
        $_SESSION['playerHand'] = drawCard($_SESSION['playerHand']);
    } elseif ($_POST['action'] == 'stand') {
        // Gracz kończy turę, teraz tura dealera
        while (calculatePoints($_SESSION['dealerHand']) < 17) {
            $_SESSION['dealerHand'] = drawCard($_SESSION['dealerHand']);
        }
    }
}

// Rozpoczęcie gry: rozdajemy po dwie karty graczowi i dealerowi
if (empty($_SESSION['playerHand']) && empty($_SESSION['dealerHand'])) {
    $_SESSION['playerHand'] = drawCard($_SESSION['playerHand']);
    $_SESSION['dealerHand'] = drawCard($_SESSION['dealerHand']);
    $_SESSION['playerHand'] = drawCard($_SESSION['playerHand']);
    $_SESSION['dealerHand'] = drawCard($_SESSION['dealerHand']);
}

// Wyświetlanie wyników
$playerPoints = calculatePoints($_SESSION['playerHand']);
$dealerPoints = calculatePoints($_SESSION['dealerHand']);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack</title>
</head>
<body>
    <h1>Gra w Blackjack</h1>

    <h2>Ręka gracza:</h2>
    <p>
        <?php foreach ($_SESSION['playerHand'] as $card) {
            echo $card . " ";
        } ?>
    </p>
    <p>Punkty gracza: <?php echo $playerPoints; ?></p>

    <h2>Ręka dealera:</h2>
    <p>
        <?php
        echo $_SESSION['dealerHand'][0] . " ?"; // Pokazujemy tylko jedną kartę dealera
        ?>
    </p>

    <form method="post">
        <?php if ($playerPoints < 21) { ?>
            <button type="submit" name="action" value="hit">Dobierz kartę</button>
        <?php } ?>
        <button type="submit" name="action" value="stand">Zakończ turę</button>
    </form>

    <?php if ($playerPoints >= 21 || $dealerPoints >= 17) { ?>
        <h2>Wyniki:</h2>
        <p>Ręka dealera:</p>
        <p>
            <?php foreach ($_SESSION['dealerHand'] as $card) {
                echo $card . " ";
            } ?>
        </p>
        <p>Punkty dealera: <?php echo $dealerPoints; ?></p>

        <?php
        if ($playerPoints > 21) {
            echo "<p>Przegrałeś, przekroczyłeś 21 punktów!</p>";
        } elseif ($dealerPoints > 21) {
            echo "<p>Wygrałeś, dealer przekroczył 21 punktów!</p>";
        } elseif ($playerPoints > $dealerPoints) {
            echo "<p>Wygrałeś!</p>";
        } elseif ($playerPoints < $dealerPoints) {
            echo "<p>Przegrałeś!</p>";
        } else {
            echo "<p>Remis!</p>";
        }
        ?>
        <form method="post">
            <button type="submit" name="action" value="start">Nowa gra</button>
        </form>
    <?php } ?>
</body>
</html>
