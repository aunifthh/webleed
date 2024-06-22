<?php
session_start();

// Check if the user is logged in as a staff member
if (!isset($_SESSION['staffID'])) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include the database connection file
include('connection.php');

// Process delete action
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['sampleNo'])) {
    $sampleNo = mysqli_real_escape_string($condb, $_GET['sampleNo']);

    $delete_query = "DELETE FROM bloodsample WHERE sampleNo = '$sampleNo'";

    if (mysqli_query($condb, $delete_query)) {
        echo "<script>alert('Blood sample deleted successfully.');</script>";
        mysqli_close($condb);
        header("Location: bloodsample_details.php");
        exit();
    } else {
        echo "<script>alert('Error deleting blood sample: " . mysqli_error($condb) . "');</script>";
    }
}

mysqli_close($condb);
?>
