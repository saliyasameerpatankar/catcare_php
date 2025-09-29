<?php
include 'dbcon.php';

// Allow CORS (for Android app / frontend API calls)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Extract and trim inputs
$email = trim($data['email'] ?? '');
$password = trim($data['password'] ?? '');
$firstname = trim($data['firstname'] ?? '');
$lastname = trim($data['lastname'] ?? '');

// Validate inputs
if (empty($email) || empty($password) || empty($firstname) || empty($lastname)) {
    echo json_encode(["status" => "error", "message" => "Please provide all required fields"]);
    exit;
}

// Check DB connection
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

// Check if email already exists
$stmt = $conn->prepare("SELECT email FROM auth_user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Email already registered"]);
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();

// Hash the password securely
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert new user
$insert_stmt = $conn->prepare("INSERT INTO auth_user (email, password, firstname, lastname) VALUES (?, ?, ?, ?)");
$insert_stmt->bind_param("ssss", $email, $hashed_password, $firstname, $lastname);

if ($insert_stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Account created successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to create account"]);
}

$insert_stmt->close();
$conn->close();
exit;
?>