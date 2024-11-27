<?php
$host = 'localhost';
$db = 'rezystory';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $band1 = $_POST['band1'];
    $band2 = $_POST['band2'];
    $multiplier = $_POST['multiplier'];
    $tolerance = $_POST['tolerance'];
    $result = $_POST['result'];

    $stmt = $conn->prepare("INSERT INTO obliczenia (band1, band2, multiplier, tolerance, result) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiss", $band1, $band2, $multiplier, $tolerance, $result);
    $stmt->execute();
    $stmt->close();
}

if (isset($_GET['action']) && $_GET['action'] === 'get_results') {
    $query = "SELECT band1, band2, multiplier, tolerance, result, timestamp FROM obliczenia ORDER BY id DESC LIMIT 5";
    $results = $conn->query($query);

    $data = [];
    while ($row = $results->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

$conn->close();
?>
