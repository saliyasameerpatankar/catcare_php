<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "dbcon.php";

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $catid = isset($_POST['catid']) ? intval($_POST['catid']) : 0;

    if ($catid <= 0) {
        echo json_encode(["status" => "error", "message" => "Invalid catid"]);
        exit;
    }

    if (isset($_FILES['photo'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $filename = time() . "_" . basename($_FILES["photo"]["name"]);
        $targetFile = $targetDir . $filename;

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // Save in DB
            $stmt = $conn->prepare("INSERT INTO photo_entries (catid, filename, uploaded_at) VALUES (?, ?, NOW())");
            $stmt->bind_param("is", $catid, $filename);
            if ($stmt->execute()) {
                $id = $stmt->insert_id;
                $url = "http://localhost/catcare/uploads/" . $filename;

                $response = [
                    "status" => "success",
                    "photo" => [
                        "id" => $id,
                        "catid" => $catid,
                        "filename" => $filename,
                        "uploaded_at" => date("Y-m-d H:i:s"),
                        "url" => $url
                    ]
                ];
            } else {
                $response = ["status" => "error", "message" => "DB insert failed"];
            }
            $stmt->close();
        } else {
            $response = ["status" => "error", "message" => "File upload failed"];
        }
    } else {
        $response = ["status" => "error", "message" => "No file uploaded"];
    }
}

echo json_encode($response);
$conn->close();
?>
