<?php
// check_cat_profiles.php

header("Content-Type: application/json; charset=UTF-8");
include 'dbcon.php'; // Your DB connection (make sure $conn is mysqli instance)

// Read input (supports JSON and form-data)
$input = json_decode(file_get_contents("php://input"), true);

if (is_array($input) && array_key_exists('userid', $input)) {
    $userid = $input['userid'];
} elseif (isset($_POST['userid'])) {
    $userid = $_POST['userid'];
} else {
    $userid = null;
}

// Validate userid
if (!$userid || !is_numeric($userid)) {
    echo json_encode([
        "status" => "error",
        "message" => "Valid User ID is required"
    ]);
    exit();
}

// Prepare SQL query - Adjust column names below if your DB columns are different
$sql = "SELECT catid,catname, age, breed, photo  FROM cat_profile WHERE userid = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "status" => "error",
        "message" => "Database prepare error: " . $conn->error
    ]);
    exit();
}

$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

$catProfiles = [];
while ($row = $result->fetch_assoc()) {
    // Map DB columns to expected JSON keys (change keys here if needed)
    $catProfiles[] = [
        "catid" => $row['catid'],
        "catname" => $row['catname'],
        "age" => $row['age'],
        "breed" => $row['breed'],
        "photo" => $row['photo']
    ];
}

if (!empty($catProfiles)) {
    echo json_encode([
        "status" => "success",
        "profiles" => $catProfiles
    ]);
} else {
    echo json_encode([
        "status" => "empty",
        "message" => "No cat profiles found."
    ]);
}

$stmt->close();
$conn->close();
?>
