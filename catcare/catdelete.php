<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "dbcon.php";

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get catid from POST body
    $catid = isset($_POST['catid']) ? intval($_POST['catid']) : 0;

    if ($catid > 0) {
        $sql = "DELETE FROM cat_profile WHERE catid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $catid);

        if ($stmt->execute()) {
            $response['status'] = "success";
            $response['message'] = "Cat profile deleted successfully";
        } else {
            $response['status'] = "error";
            $response['message'] = "Failed to delete cat profile";
        }

        $stmt->close();
    } else {
        $response['status'] = "error";
        $response['message'] = "Invalid catid";
    }
} else {
    $response['status'] = "error";
    $response['message'] = "Invalid request method";
}

echo json_encode($response);
$conn->close();
?>
