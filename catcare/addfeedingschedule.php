<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$host = "localhost";
$user = "root"; // change if needed
$pass = "";
$db   = "catcare";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "DB connection failed"]));
}

// Read POST data
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['catid']) || !isset($data['feeding_time']) || !isset($data['food_type'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit();
}

$catid        = $conn->real_escape_string($data['catid']);
$feeding_time = $conn->real_escape_string($data['feeding_time']);
$food_type    = $conn->real_escape_string($data['food_type']);
$notes        = isset($data['notes']) ? $conn->real_escape_string($data['notes']) : "";

// Insert into DB
$sql = "INSERT INTO feeding_schedule (catid, feeding_time, food_type, notes) 
        VALUES ('$catid', '$feeding_time', '$food_type', '$notes')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Feeding schedule created"]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
