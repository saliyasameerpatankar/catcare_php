<?php
header('Content-Type: application/json');

// Read JSON input (POST body)
$input = json_decode(file_get_contents("php://input"), true);

// Check if userid is provided
if (!isset($input['userid'])) {
    echo json_encode(['error' => 'User ID not provided']);
    exit;
}

$user_id = intval($input['userid']);

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "catcare";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// ✅ Fetch username from auth_user
$user_query = "SELECT firstname AS username FROM auth_user WHERE userid = ?";
$stmt_user = $conn->prepare($user_query);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$stmt_user->bind_result($username);
$stmt_user->fetch();
$stmt_user->close();

if (!$username) {
    echo json_encode(['error' => 'User not found']);
    exit;
}

// ✅ Fetch cats linked to userid from cat_profile
$cat_query = "SELECT catname AS name, breed, age, photo FROM cat_profile WHERE userid = ?";
$stmt_cat = $conn->prepare($cat_query);
$stmt_cat->bind_param("i", $user_id);
$stmt_cat->execute();
$result = $stmt_cat->get_result();

$cats = [];
while ($row = $result->fetch_assoc()) {
    $cats[] = $row;
}
$stmt_cat->close();
$conn->close();

// ✅ Response JSON
$response = [
    'username' => $username,
    'cats' => $cats
];

echo json_encode($response, JSON_PRETTY_PRINT);