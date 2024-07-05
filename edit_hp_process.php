<?php
session_start();
include('connection.php');

// Validate and sanitize input
$original_staffID = mysqli_real_escape_string($condb, $_POST['original_staffID']);
$staffPassword = mysqli_real_escape_string($condb, $_POST['staffPassword']);
$bcID = mysqli_real_escape_string($condb, $_POST['bcID']);

// Update healthcare provider information in the database
$update_query = "UPDATE staff SET staffPassword = '$staffPassword', bcID = '$bcID' WHERE staffID = '$original_staffID'";

if (mysqli_query($condb, $update_query)) {
    echo "<script>alert('Healthcare provider information updated successfully.'); window.location.href = 'hp_details.php';</script>";
} else {
    echo "<script>alert('Error updating healthcare provider information: " . mysqli_error($condb) . "');</script>";
}

mysqli_close($condb);
?>
