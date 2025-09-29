<?php
include "dbcon.php";

$users = json_decode(file_get_contents("php://input"), true);

// Debug check
if ($users === null) {
    echo json_encode(["error" => "Invalid or missing JSON input"]);
    exit();
}

$response = array();
$response['success'] = [];
$response['failed'] = [];

foreach ($users as $user) {
    $email = $user['email'] ?? null;
    $password = $user['password'] ?? null;
    $firstname = $user['firstname'] ?? null;
    $lastname = $user['lastname'] ?? null;

    if (!$email || !$password) {
        $response['failed'][] = [
            'email' => $email,
            'message' => 'Missing email or password'
        ];
        continue;
    }

    $stmt = $conn->prepare("INSERT INTO auth_user (email, password, firstname, lastname) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $password, $firstname, $lastname);

    if ($stmt->execute()) {
        $response['success'][] = [
            'email' => $email,
            'message' => 'Registered successfully'
        ];
    } else {
        $response['failed'][] = [
            'email' => $email,
            'message' => 'Error: ' . $stmt->error
        ];
    }

    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($response);
?>
