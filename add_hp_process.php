<?php
session_start();
include('connection.php');

// Validate and sanitize input
$hpID = mysqli_real_escape_string($condb, $_POST['hpID']);
$hpPassword = mysqli_real_escape_string($condb, $_POST['hpPassword']);
$sampleNo = mysqli_real_escape_string($condb, $_POST['sampleNo']);

// Check if hp ID already exists
$check_query = "SELECT * FROM healthcareprovider WHERE hpID = '$hpID'";
$check_result = mysqli_query($condb, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // ID already exists
    echo "<script>alert('ID already exists. Please choose a different ID.'); window.location.href = 'add_hp.php';</script>";
} else {
    // Insert new healthcare provider into database
    $insert_query = "INSERT INTO healthcareprovider (hpID, hpPassword, sampleNo) VALUES ('$hpID', '$hpPassword', '$sampleNo')";

    if (mysqli_query($condb, $insert_query)) {
        echo "<script>alert('Healthcare provider added successfully.'); window.location.href = 'hp_details.php';</script>";
    } else {
        echo "<script>alert('Error adding healthcare provider: " . mysqli_error($condb) . "');</script>";
    }
}

mysqli_close($condb);
?>
