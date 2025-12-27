<?php
// Debug script for Gemini API (Final Verification)
$secrets = include 'includes/secrets.php';
$apiKey = $secrets['GEMINI_API_KEY'];
$model = $secrets['GEMINI_MODEL'];

echo "Testing Model: $model\n";

$url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
$payload = json_encode(['contents' => [['role' => 'user', 'parts' => [['text' => 'Hello']]]]]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response Preview: " . substr($response, 0, 200) . "...\n";
?>