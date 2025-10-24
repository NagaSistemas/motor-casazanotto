<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$clientId = 'client_id_960o8MMPfTi3E2PVVCZ7S0RRgCkX';
$clientSecret = 'client_secret_9605Y3wx0CNYQZdGvqh3PjH';

$endpoint = $_GET['endpoint'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

if (!$endpoint) {
    http_response_code(400);
    echo json_encode(['error' => 'Endpoint required']);
    exit;
}

$url = 'https://artaxnet.com/pms-api/v1/' . $endpoint;
if ($_SERVER['QUERY_STRING']) {
    $query = $_SERVER['QUERY_STRING'];
    $query = preg_replace('/endpoint=[^&]*&?/', '', $query);
    if ($query) {
        $url .= '?' . $query;
    }
}

$headers = [
    'ClientId: ' . $clientId,
    'ClientSecret: ' . $clientSecret,
    'Content-Type: application/json'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

if ($method === 'POST') {
    curl_setopt($ch, CURLOPT_POST, true);
    $input = file_get_contents('php://input');
    if ($input) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $input);
    }
}

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

http_response_code($httpCode);
echo $response;
?>