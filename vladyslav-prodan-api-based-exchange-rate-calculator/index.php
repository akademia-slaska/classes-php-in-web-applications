<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konwerter Walut</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Konwerter Walut (PLN → EUR/USD/UAH)</h2>
    <form action="convert.php" method="POST">
        <label for="amount">Kwota w PLN:</label>
        <input type="number" name="amount" step="0.01" required>
        
        <label for="currency">Wybierz walutę:</label>
        <select name="currency">
            <option value="EUR">Euro (EUR)</option>
            <option value="USD">Dolar amerykański (USD)</option>
            <option value="UAH">Hrywna ukraińska (UAH)</option>
        </select>
        
        <button type="submit">Konwertuj</button>
    </form>
</body>
</html>