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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bcID = mysqli_real_escape_string($condb, $_POST['bcID']);
    $bcName = mysqli_real_escape_string($condb, $_POST['bcName']);
    $bcPhoneNo = mysqli_real_escape_string($condb, $_POST['bcPhoneNo']);
    $bcBloodQtyA = mysqli_real_escape_string($condb, $_POST['bcBloodQtyA']);
    $bcBloodQtyB = mysqli_real_escape_string($condb, $_POST['bcBloodQtyB']);
    $bcBloodQtyO = mysqli_real_escape_string($condb, $_POST['bcBloodQtyO']);
    $bcBloodQtyAB = mysqli_real_escape_string($condb, $_POST['bcBloodQtyAB']);

    // Check if the bcID already exists
    $check_query = "SELECT * FROM bloodcenter WHERE bcID = '$bcID'";
    $check_result = mysqli_query($condb, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Blood Center ID already exists. Please enter a unique ID.'); window.location.href='add_bloodcenter.php';</script>";
    } else {
        $insert_query = "INSERT INTO bloodcenter (bcID, bcName, bcPhoneNo, bcBloodQtyA, bcBloodQtyB, bcBloodQtyO, bcBloodQtyAB) 
                         VALUES ('$bcID', '$bcName', '$bcPhoneNo', '$bcBloodQtyA', '$bcBloodQtyB', '$bcBloodQtyO', '$bcBloodQtyAB')";

        if (mysqli_query($condb, $insert_query)) {
            echo "<script>alert('Blood center added successfully.'); window.location.href='bloodcenter_details.php';</script>";
        } else {
            echo "<script>alert('Error adding blood center: " . mysqli_error($condb) . "');</script>";
        }
    }
}

mysqli_close($condb);
?>
