<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "dbcon.php"; // your db connection

// Helper: fetch POST/JSON input
function getRequestData() {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);
    return $data ? $data : $_POST;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "GET":
    // Optional: filter by catid
    $catid = isset($_GET['catid']) ? intval($_GET['catid']) : null;

    $sql = "SELECT * FROM weight_entries";
    if ($catid) {
        $sql .= " WHERE catid = $catid";
    }
    $sql .= " ORDER BY date DESC";

    $result = $conn->query($sql);

    $entries = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $entries[] = $row;
        }
    }

    // 🚨 IMPORTANT: return only the array, no wrapper
    echo json_encode($entries);
    exit;


    case "POST":
        $data = getRequestData();

        if (!isset($data['catid'], $data['date'], $data['weight'])) {
            echo json_encode([
                "status" => "error",
                "message" => "catid, date, and weight are required"
            ]);
            exit;
        }

        $catid = intval($data['catid']);
        $date = $conn->real_escape_string($data['date']);
        $weight = floatval($data['weight']);
        $notes = isset($data['notes']) ? $conn->real_escape_string($data['notes']) : NULL;

        $sql = "INSERT INTO weight_entries (catid, date, weight, notes) 
                VALUES ('$catid', '$date', '$weight', " . ($notes ? "'$notes'" : "NULL") . ")";

        if ($conn->query($sql)) {
            $last_id = $conn->insert_id;
            echo json_encode([
                "status" => "success",
                "message" => "Weight entry added successfully",
                "data" => [
                    "id" => $last_id,
                    "catid" => $catid,
                    "date" => $date,
                    "weight" => $weight,
                    "notes" => $notes
                ]
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "DB Error: " . $conn->error
            ]);
        }
        break;

    default:
        echo json_encode([
            "status" => "error",
            "message" => "Method not supported"
        ]);
        break;
}

$conn->close();
?>
