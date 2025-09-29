<?php
header("Content-Type: application/json");

// Database connection
$servername = "localhost";
$username   = "root";      // change if needed
$password   = "";          // change if needed
$dbname     = "catcare";   // ✅ your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed"
    ]);
    exit();
}

// Get POST parameters
$catid                 = isset($_POST['catid']) ? $conn->real_escape_string($_POST['catid']) : '';
$next_appointment_date = isset($_POST['next_appointment_date']) ? $conn->real_escape_string($_POST['next_appointment_date']) : '';
$next_appointment_time = isset($_POST['next_appointment_time']) ? $conn->real_escape_string($_POST['next_appointment_time']) : '';
$reason_or_visit_type  = isset($_POST['reason_or_visit_type']) ? $conn->real_escape_string($_POST['reason_or_visit_type']) : '';
$clinic_name           = isset($_POST['clinic_name']) ? $conn->real_escape_string($_POST['clinic_name']) : '';
$vet_name              = isset($_POST['vet_name']) ? $conn->real_escape_string($_POST['vet_name']) : '';
$vet_phone_number      = isset($_POST['vet_phone_number']) ? $conn->real_escape_string($_POST['vet_phone_number']) : '';
$last_visit_date       = isset($_POST['last_visit_date']) ? $conn->real_escape_string($_POST['last_visit_date']) : '';

if (empty($catid) || empty($next_appointment_date) || empty($next_appointment_time) || empty($reason_or_visit_type) || empty($clinic_name) || empty($vet_name) || empty($vet_phone_number)) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing required fields"
    ]);
    exit();
}

// Insert query
$sql = "INSERT INTO vetappointments (catid, next_appointment_date, next_appointment_time, 
                                     reason_or_visit_type, clinic_name, vet_name, vet_phone_number, last_visit_date) 
        VALUES ('$catid', '$next_appointment_date', '$next_appointment_time', 
                '$reason_or_visit_type', '$clinic_name', '$vet_name', '$vet_phone_number', '$last_visit_date')";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => "success",
        "message" => "Appointment added successfully",
        "appointmentid" => $conn->insert_id
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Error: " . $conn->error
    ]);
}

$conn->close();
?>
