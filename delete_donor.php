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

if (isset($_GET['id'])) {
    $donID = $_GET['id'];
    $query = "DELETE FROM donor WHERE donID = '$donID'";

    if (mysqli_query($condb, $query)) {
        echo "Donor deleted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($condb);
    }

    mysqli_close($condb);
    header("Location: donor_details.php");
    exit();
} else {
    echo "No donor ID specified.";
    exit();
}
?>
