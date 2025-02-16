<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = floatval($_POST['amount']);
    $currency = $_POST['currency'];
    
    $apiUrl = "https://api.nbp.pl/api/exchangerates/rates/A/" . $currency . "/?format=json";
    
    $response = file_get_contents($apiUrl);
    
    if ($response) {
        $data = json_decode($response, true);
        $exchangeRate = $data['rates'][0]['mid'];
        
        $convertedAmount = $amount / $exchangeRate;
        
        echo "<h2>Wynik konwersji</h2>";
        echo "<p>$amount PLN = " . round($convertedAmount, 2) . " $currency</p>";
        echo "<a href='index.php'>Powrót</a>";
    } else {
        echo "<p>Błąd pobierania danych z API NBP.</p>";
    }
}
?>