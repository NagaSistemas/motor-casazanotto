<?php
header('Content-Type: application/json');

// Token secreto para validação
$secret = 'client_secret_9605Y3wx0CNYQZdGvqh3PjH';

// Receber dados
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_SIGNATURE'] ?? '';

// Validar assinatura
$expected = 'sha256=' . hash_hmac('sha256', $payload, $secret);
if (!hash_equals($expected, $signature)) {
    http_response_code(401);
    exit('Invalid signature');
}

// Processar webhook
$data = json_decode($payload, true);
$event = $data['event'] ?? '';
$booking_id = $data['data']['booking_id'] ?? 0;

// Log do evento
$log = date('Y-m-d H:i:s') . " - Event: $event, Booking ID: $booking_id\n";
file_put_contents('webhook.log', $log, FILE_APPEND);

// Processar eventos
switch ($event) {
    case 'booking_created':
        // Notificar nova reserva
        break;
    case 'booking_canceled':
        // Processar cancelamento
        break;
}

http_response_code(200);
echo json_encode(['status' => 'success']);
?>