<?php
$servername = "localhost";
$username = "root"; // domyślnie dla XAMPP
$password = ""; // domyślne hasło dla XAMPP
$dbname = "bmi_calculator";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bmiResults = [];
$bmi = null;
$bmiCategory = '';
$bmiClass = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    $bmi = $weight / (($height / 100) ** 2);
    $bmi = round($bmi, 2); // Zaokrąglanie do dwóch miejsc po przecinku

    if ($bmi < 18.5) {
        $bmiCategory = 'Niedowaga';
        $bmiClass = 'underweight';
    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
        $bmiCategory = 'Dobre BMI';
        $bmiClass = 'normal';
    } else {
        $bmiCategory = 'Nadwaga';
        $bmiClass = 'overweight';
    }

    $stmt = $conn->prepare("INSERT INTO bmi_results (name, surname, gender, height, weight, bmi) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdid", $name, $surname, $gender, $height, $weight, $bmi);
    $stmt->execute();
    $stmt->close();
}

$result = $conn->query("SELECT name, surname, gender, height, weight, bmi, created_at FROM bmi_results ORDER BY created_at DESC LIMIT 5");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bmiResults[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator BMI</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container">
        <h1>Kalkulator BMI</h1>
        <form method="post">
            <label for="name">Imię:</label>
            <input type="text" id="name" name="name" required>

            <label for="surname">Nazwisko:</label>
            <input type="text" id="surname" name="surname" required>

            <label for="gender">Płeć:</label>
            <select id="gender" name="gender" required>
                <option value="male">Mężczyzna</option>
                <option value="female">Kobieta</option>
            </select>

            <label for="height">Wzrost (cm):</label>
            <input type="number" id="height" name="height" required>

            <label for="weight">Waga (kg):</label>
            <input type="number" id="weight" name="weight" required>

            <input type="submit" value="Oblicz BMI">
        </form>

        <div class="result">
            <?php if ($bmi !== null): ?>
                <h2 class="<?php echo $bmiClass; ?>">Twoje BMI: <?php echo htmlspecialchars($bmi); ?> - <?php echo htmlspecialchars($bmiCategory); ?></h2>
            <?php endif; ?>
        </div>

        <div class="history">
            <h2>Ostatnie wyniki BMI:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Płeć</th>
                        <th>Wzrost (cm)</th>
                        <th>Waga (kg)</th>
                        <th>BMI</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bmiResults)): ?>
                        <?php foreach ($bmiResults as $result): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($result['name']); ?></td>
                                <td><?php echo htmlspecialchars($result['surname']); ?></td>
                                <td><?php echo htmlspecialchars($result['gender']); ?></td>
                                <td><?php echo htmlspecialchars($result['height']); ?></td>
                                <td><?php echo htmlspecialchars($result['weight']); ?></td>
                                <td><?php echo htmlspecialchars($result['bmi']); ?></td>
                                <td><?php echo $result['created_at']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Brak danych</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="bmi-ranges">
            <h2>Progi BMI</h2>
            <table>
                <thead>
                    <tr>
                        <th>Kategoria</th>
                        <th>Zakres BMI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="color: red;">Niedowaga</td>
                        <td>&lt; 18.5</td>
                    </tr>
                    <tr>
                        <td style="color: green;">Dobre BMI</td>
                        <td>18.5 - 24.9</td>
                    </tr>
                    <tr>
                        <td style="color: orange;">Nadwaga</td>
                        <td>&gt;= 25</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
