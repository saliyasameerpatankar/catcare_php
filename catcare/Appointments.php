<?php
// Database connection settings - replace these with your actual credentials
$servername = "localhost";
$username = "root";        // your DB username
$password = "";            // your DB password (often empty for XAMPP)
$dbname = "catcare";      // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create vetappointments table
$sql = "CREATE TABLE IF NOT EXISTS vetappointments (
    appointmentid INT PRIMARY KEY AUTO_INCREMENT,
    catid INT(10) UNSIGNED NOT NULL,
    next_appointment_date DATE,
    next_appointment_time TIME,
    reason_or_visit_type VARCHAR(255),
    clinic_name VARCHAR(255),
    vet_name VARCHAR(255),
    vet_phone_number VARCHAR(50),
    last_visit_date DATE,
    prescription_notes TEXT,
    FOREIGN KEY (catid) REFERENCES cat_profile(catid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

// Run the query and check for success or failure
if ($conn->query($sql) === TRUE) {
    echo "Table 'vetappointments' created successfully or already exists.";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
