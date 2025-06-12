<?php
$reason = $_POST['reason'] ?? '';

if (trim($reason) === '') {
    echo json_encode(['error' => 'Empty reason']);
    exit;
}

$escaped_reason = escapeshellarg($reason);
$output = shell_exec("python3 enhance_reason.py $escaped_reason");

header('Content-Type: application/json');
echo $output;
?>