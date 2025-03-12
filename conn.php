<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'db_leave');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>