<?php
// Enable error reporting (for development only)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set headers
header("Content-Type: application/json");

// Include DB connection
require 'dbcon.php';

// Validate POST input
if (
    !isset($_POST['catid']) ||
    !isset($_POST['task_name']) ||
    !isset($_POST['frequency']) ||
    !isset($_POST['last_done']) ||
    !isset($_POST['next_due'])
) {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    exit;
}

// Clean and assign POST input
$catId     = (int) $_POST['catid']; // ensure numeric
$taskName  = $conn->real_escape_string($_POST['task_name']);
$frequency = $conn->real_escape_string($_POST['frequency']);
$lastDone  = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['last_done'])));
$nextDue   = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['next_due'])));

// Insert query
$sql = "INSERT INTO grooming_tasks (id, task_name, frequency, last_done, next_due)
        VALUES ($catId, '$taskName', '$frequency', '$lastDone', '$nextDue')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Task added successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Insert failed: " . $conn->error]);
}

// Close connection
$conn->close();
?>
