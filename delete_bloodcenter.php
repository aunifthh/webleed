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
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['bcID'])) {
    $bcID = mysqli_real_escape_string($condb, $_GET['bcID']);

    $delete_query = "DELETE FROM bloodcenter WHERE bcID = '$bcID'";

    if (mysqli_query($condb, $delete_query)) {
        echo "<script>alert('Blood center deleted successfully.');</script>";
        mysqli_close($condb);
        header("Location: bloodcenter_details.php");
        exit();
    } else {
        echo "<script>alert('Error deleting blood center: " . mysqli_error($condb) . "');</script>";
    }
}

mysqli_close($condb);
?>
