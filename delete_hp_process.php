<?php
session_start();
include('connection.php');

// Check if staffID is provided via POST parameter
if (isset($_POST['staffID'])) {
    $staffID = mysqli_real_escape_string($condb, $_POST['staffID']);

    // Delete healthcare provider from the database
    $delete_query = "DELETE FROM staff WHERE staffID = '$staffID'";

    if (mysqli_query($condb, $delete_query)) {
        echo "<script>alert('Healthcare provider deleted successfully.'); window.location.href = 'hp_details.php';</script>";
    } else {
        echo "<script>alert('Error deleting healthcare provider: " . mysqli_error($condb) . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
}

mysqli_close($condb);
?>
