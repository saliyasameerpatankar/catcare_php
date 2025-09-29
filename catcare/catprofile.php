<?php
include 'dbcon.php';  // Your DB connection file

// Read raw POST data
$data = json_decode(file_get_contents("php://input"), true);

// Assign values from request
$userid = $data['userid'];
$catname = $data['catname'];
$age = $data['age'];
$breed = $data['breed'];
$gender = $data['gender'];
$notes = $data['notes'];
$photo = $data['photo']; // Can be a filename or URL

// Validate required fields
if (!$userid || !$catname || !$age || !$breed || !$gender) {
    echo json_encode([
        "status" => "error",
        "message" => "Please fill all required fields"
    ]);
    exit;
}

// Insert into table
$sql = "INSERT INTO cat_profile (userid, catname, age, breed, gender, notes, photo)
        VALUES ('$userid', '$catname', '$age', '$breed', '$gender', '$notes', '$photo')";

// Execute query
if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => "success",
        "message" => "Cat profile saved successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $conn->error
    ]);
}
?>
