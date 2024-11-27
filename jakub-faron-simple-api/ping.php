<?php
header('Content-Type: application/json');

// Prosta odpowiedź, że serwer działa
$response = [
    'status' => 'success',
    'message' => 'API is reachable.'
];

echo json_encode($response);
