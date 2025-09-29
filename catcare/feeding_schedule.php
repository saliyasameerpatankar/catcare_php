<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Database connection
$host = "localhost";       // your DB host
$user = "root";            // your DB username
$pass = "";                // your DB password
$dbname = "catcare";       // updated DB name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit();
}

// Get catid from URL
if (!isset($_GET['catid'])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Missing catid"]);
    exit();
}

$catid = intval($_GET['catid']);

// Query feeding schedule
$sql = "SELECT * FROM feeding_schedule WHERE catid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $catid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Feeding schedule exists
    $schedules = [];
    while ($row = $result->fetch_assoc()) {
        $schedules[] = $row;
    }
    echo json_encode([
        "success" => true,
        "hasSchedule" => true,
        "data" => $schedules
    ]);
} else {
    // No feeding schedule
    echo json_encode([
        "success" => true,
        "hasSchedule" => false,
        "data" => []
    ]);
}

$stmt->close();
$conn->close();
?>
