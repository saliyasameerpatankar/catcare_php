<?php
// Database connection
require 'dbcon.php';

// Read POST data
$catid = isset($_POST['id']) ? intval($_POST['id']) : 
         (isset($_GET['id']) ? intval($_GET['id']) : 0);


if ($catid <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid catid"]);
    exit;
}

// Prepare SQL
$sql = "SELECT task_name, frequency, last_done, next_due 
        FROM grooming_tasks 
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $catid);
$stmt->execute();
$result = $stmt->get_result();

$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

header('Content-Type: application/json');

if (count($tasks) > 0) {
    echo json_encode(["status" => "success", "data" => $tasks]);
} else {
    echo json_encode(["status" => "success", "data" => []]);
}

$stmt->close();
$conn->close();
?>
