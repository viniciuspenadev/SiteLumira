<?php
// Script to list valid Gemini Models
$secrets = include 'includes/secrets.php';
$apiKey = $secrets['GEMINI_API_KEY'];

$url = "https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if (isset($data['models'])) {
    echo "Available Models:\n";
    foreach ($data['models'] as $m) {
        // Output name (e.g. models/gemini-pro)
        echo $m['name'] . "\n";
    }
} else {
    echo "No models found or error:\n";
    echo $response;
}
?>