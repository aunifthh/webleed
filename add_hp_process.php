<?php
session_start();
include('connection.php');

// Validate and sanitize input
$staffID = mysqli_real_escape_string($condb, $_POST['staffID']);
$staffPassword = mysqli_real_escape_string($condb, $_POST['staffPassword']);
$sampleNo = mysqli_real_escape_string($condb, $_POST['sampleNo']);

// Check if staff ID already exists
$check_query = "SELECT * FROM staff WHERE staffID = '$staffID'";
$check_result = mysqli_query($condb, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // ID already exists
    echo "<script>alert('ID already exists. Please choose a different ID.'); window.location.href = 'add_hp.php';</script>";
} else {
    // Insert new healthcare provider into database
    $insert_query = "INSERT INTO staff (staffID, staffPassword, bcID) VALUES ('$staffID', '$staffPassword', '$sampleNo')";

    if (mysqli_query($condb, $insert_query)) {
        echo "<script>alert('Healthcare provider added successfully.'); window.location.href = 'hp_details.php';</script>";
    } else {
        echo "<script>alert('Error adding healthcare provider: " . mysqli_error($condb) . "');</script>";
    }
}

mysqli_close($condb);
?>
