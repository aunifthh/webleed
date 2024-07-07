<?php
session_start();
include('connection.php');

// Validate and sanitize input
$hpID = mysqli_real_escape_string($condb, $_POST['hpID']);
$hpPassword = mysqli_real_escape_string($condb, $_POST['hpPassword']);
$sampleNo = mysqli_real_escape_string($condb, $_POST['sampleNo']);

// Update healthcare provider information in the database
$update_query = "UPDATE healthcareprovider SET hpPassword = '$hpPassword', sampleNo = '$sampleNo' WHERE hpID = '$hpID'";

if (mysqli_query($condb, $update_query)) {
    echo "<script>alert('Healthcare provider information updated successfully.'); window.location.href = 'hp_details.php';</script>";
} else {
    echo "<script>alert('Error updating healthcare provider information: " . mysqli_error($condb) . "');</script>";
}

mysqli_close($condb);
?>
