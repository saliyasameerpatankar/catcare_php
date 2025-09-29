<?php
header('Content-Type: application/json');

$host = "localhost";
$db = "catcare";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Collect POST data safely
$userid = isset($_POST['userid']) ? intval($_POST['userid']) : null;
$catname = isset($_POST['catname']) ? $_POST['catname'] : null;
$age = isset($_POST['age']) ? intval($_POST['age']) : null;
$breed = isset($_POST['breed']) ? $_POST['breed'] : null;
$gender = isset($_POST['gender']) ? $_POST['gender'] : null;
$photo = null; // You can handle photo uploads if needed

if (!$userid || !$catname || !$age || !$breed || !$gender) {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    exit;
}

// Insert the cat profile into the database
$stmt = $conn->prepare("INSERT INTO cat_profile (userid, catname, age, breed, gender, photo) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isisss", $userid, $catname, $age, $breed, $gender, $photo);

if ($stmt->execute()) {
    $catid = $stmt->insert_id;

    $response = [
        "status" => "success",
        "message" => "Profile added successfully",
        "data" => [
            "catid" => $catid,
            "userid" => $userid,
            "catname" => $catname,
            "age" => strval($age),
            "breed" => $breed,
            "gender" => $gender,
            "photo" => $photo
        ]
    ];
    echo json_encode($response);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to add cat profile"]);
}

$stmt->close();
$conn->close();
