<?php
header('Content-Type: application/json');

$host = "localhost";
$db = "catcare";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$profiles = [];

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    $stmt = $conn->prepare("SELECT * FROM cat_profile WHERE userid = ?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $profiles[] = $row;
    }
    $stmt->close();
} else {
    $result = $conn->query("SELECT * FROM cat_profile");
    while ($row = $result->fetch_assoc()) {
        $profiles[] = $row;
    }
}

$response = [
    "status" => "success",
    "profiles" => $profiles
];

echo json_encode($response);

$conn->close();
?>
