<?php
// Enable error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Database connection
$host = "localhost";
$user = "root";   // change if needed
$pass = "";       // change if needed
$db   = "catcare";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "DB connection failed: " . $conn->connect_error]);
    exit();
}

// ✅ Expecting multipart/form-data, not JSON
if (!isset($_POST['userid'], $_POST['catname'], $_POST['age'], $_POST['breed'], $_POST['gender'])) {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    exit();
}

$userid  = intval($_POST['userid']);
$catname = $_POST['catname'];
$age     = $_POST['age'];
$breed   = $_POST['breed'];
$gender  = $_POST['gender'];

$photoUrl = null;

// ✅ Handle file upload if present
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
    $uploadDir = "uploads/";  // make sure this folder exists and is writable
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileTmp  = $_FILES['photo']['tmp_name'];
    $fileName = time() . "_" . basename($_FILES['photo']['name']);
    $target   = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmp, $target)) {
        // Store full URL for Android
        $photoUrl = "http://" . $_SERVER['HTTP_HOST'] . "/catcare/" . $target;
    } else {
        echo json_encode(["status" => "error", "message" => "Image upload failed"]);
        exit();
    }
}

// ✅ Insert into DB with prepared statement
$sql = "INSERT INTO cat_profile (userid, catname, age, breed, gender, photo) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssss", $userid, $catname, $age, $breed, $gender, $photoUrl);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Cat profile added successfully",
        "data" => [
            "catid"   => $stmt->insert_id,
            "userid"  => $userid,
            "catname" => $catname,
            "age"     => $age,
            "breed"   => $breed,
            "gender"  => $gender,
            "photo"   => $photoUrl
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "DB Insert Failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
exit();
?>
