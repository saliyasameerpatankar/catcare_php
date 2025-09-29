<?php
header("Content-Type: application/json");

require 'dbcon.php';

$catid = isset($_POST['catid']) ? $conn->real_escape_string($_POST['catid']) : '';

if (empty($catid)) {
    echo json_encode([
        "status" => "error",
        "message" => "catid is required"
    ]);
    exit();
}

// JOIN vetappointments with cat_profile to get full cat details
$sql = "SELECT va.appointmentid, va.catid,
               cp.catname, cp.age AS cat_age, cp.breed AS cat_breed, cp.photo AS cat_photo,
               va.next_appointment_date, va.next_appointment_time, 
               va.reason_or_visit_type, va.clinic_name, 
               va.vet_name, va.vet_phone_number, va.last_visit_date
        FROM vetappointments va
        JOIN cat_profile cp ON va.catid = cp.catid
        WHERE va.catid = '$catid'";

$result = $conn->query($sql);

$appointments = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = [
            "appointmentid"         => $row["appointmentid"],
            "catid"                 => $row["catid"],
            "catname"               => $row["catname"],
            "cat_breed"             => $row["cat_breed"],
            "cat_age"               => $row["cat_age"],
            "cat_photo"             => $row["cat_photo"],
            "next_appointment_date" => $row["next_appointment_date"],
            "next_appointment_time" => $row["next_appointment_time"],
            "reason_or_visit_type"  => $row["reason_or_visit_type"],
            "clinic_name"           => $row["clinic_name"],
            "vet_name"              => $row["vet_name"],
            "vet_phone_number"      => $row["vet_phone_number"],
            "last_visit_date"       => $row["last_visit_date"]
        ];
    }

    echo json_encode([
        "status" => "success",
        "data" => $appointments
    ]);
} else {
    echo json_encode([
        "status" => "success",
        "data" => []
    ]);
}

$conn->close();
?>
