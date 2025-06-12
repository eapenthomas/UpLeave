<?php
header('Content-Type: application/json');

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Get and sanitize the input
$reason = filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING);

if (empty($reason)) {
    http_response_code(400);
    echo json_encode(['error' => 'Reason is required']);
    exit;
}

// Define rule-based mappings for common leave reasons
$replacements = [
    "sick" => "I am not feeling well due to health issues and require medical attention",
    "fever" => "I am suffering from a high fever and need rest for recovery",
    "personal work" => "I have an urgent personal commitment that requires my immediate attention",
    "family emergency" => "Due to an unforeseen family emergency, I am unable to attend work",
    "headache" => "I have a severe headache and need time to recover properly",
    "urgent work" => "I have an unavoidable personal matter that requires my immediate attention",
    "not well" => "I am not feeling well and require rest for recovery",
    "medical" => "I need to attend to a medical appointment",
    "doctor" => "I have a scheduled medical appointment that cannot be postponed",
    "hospital" => "I need to visit the hospital for medical attention",
    "family" => "I have an important family matter that requires my presence",
    "relative" => "I need to attend to an urgent family matter",
    "marriage" => "I need to attend a marriage ceremony in my family",
    "function" => "I need to attend an important family function",
    "tired" => "I am feeling exhausted and need rest to maintain my health",
    "stress" => "I need to take a break to manage my stress levels",
    "mental" => "I need to take some time off for mental well-being",
    "exhausted" => "I am feeling exhausted and need proper rest",
    "rest" => "I need to take some rest to maintain my health",
    "unwell" => "I am feeling unwell and need time to recover"
];

// Function to check for keyword matches
function findMatchingReason($reason, $replacements) {
    $reason = strtolower($reason);
    foreach ($replacements as $keyword => $formalReason) {
        if (strpos($reason, strtolower($keyword)) !== false) {
            return $formalReason;
        }
    }
    return null;
}

// Try rule-based matching first
$enhancedReason = findMatchingReason($reason, $replacements);

// If no match found, use AI enhancement
if ($enhancedReason === null) {
    // DeepSeek API configuration
    $apiKey = 'sk-f7c2c6f485b04432b19012bdc434cdd1';
    $apiUrl = 'https://api.deepseek.com/v1/chat/completions';

    // Prepare the prompt
    $prompt = "Make this reason sound more formal and professional: \"$reason\"";

    // Prepare the request data
    $data = [
        'model' => 'deepseek-chat',
        'messages' => [
            [
                'role' => 'system',
                'content' => 'You are a professional HR assistant. Only provide the enhanced leave reason without any additional text or explanations.'
            ],
            [
                'role' => 'user',
                'content' => $prompt
            ]
        ],
        'temperature' => 0.7,
        'max_tokens' => 500
    ];

    // Initialize cURL
    $ch = curl_init($apiUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);

    // Execute the request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Check for cURL errors
    if (curl_errno($ch)) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to connect to API: ' . curl_error($ch)]);
        exit;
    }

    curl_close($ch);

    // Handle API response
    if ($httpCode !== 200) {
        http_response_code($httpCode);
        echo json_encode(['error' => 'API request failed with status code: ' . $httpCode]);
        exit;
    }

    // Parse the response
    $responseData = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to parse API response']);
        exit;
    }

    // Extract the enhanced reason from the response
    if (isset($responseData['choices'][0]['message']['content'])) {
        $enhancedReason = trim($responseData['choices'][0]['message']['content']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Unexpected API response format']);
        exit;
    }
}

// Return the enhanced reason
echo json_encode(['enhanced_text' => $enhancedReason]); 