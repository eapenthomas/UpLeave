<?php
// enhance_reason.php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reason = $_POST['reason'] ?? '';

    if (empty($reason)) {
        echo json_encode(['error' => 'Reason is required']);
        exit;
    }

    // Prepare API call to DeepSeek Reasoner
    $apiUrl = 'https://api.deepseek.com/chat/completions';
    $apiKey ='sk-f7c2c6f485b04432b19012bdc434cdd1';

    $postData = json_encode(['text' => $reason]);

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "Authorization: Bearer $apiKey"
    ]);

    $response = curl_exec($ch);

    if ($response === false) {
        echo json_encode(['error' => 'API request failed: ' . curl_error($ch)]);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    // Forward the API response
    echo $response;
    exit;
}

echo json_encode(['error' => 'Invalid request']);
