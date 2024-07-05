<?php
session_start();

// Check if the user is logged in as a staff member
if (!isset($_SESSION['adminID'])) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include the database connection file
include('connection.php');

if (isset($_GET['id'])) {
    $staffID = $_GET['id'];
    $query = "DELETE FROM staff WHERE staffID = '$staffID'";

    if (mysqli_query($condb, $query)) {
        echo "Staff member deleted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($condb);
    }

    mysqli_close($condb);
    header("Location: staff_details.php");
    exit();
} else {
    echo "No staff ID specified.";
    exit();
}
?>
