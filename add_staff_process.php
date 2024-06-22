<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staffID = mysqli_real_escape_string($condb, $_POST['staffID']);
    $staffPassword = mysqli_real_escape_string($condb, $_POST['staffPassword']);
    $staffName = mysqli_real_escape_string($condb, $_POST['staffName']);
    $staffPhoneNo = mysqli_real_escape_string($condb, $_POST['staffPhoneNo']);
    $bcID = mysqli_real_escape_string($condb, $_POST['bcID']);

    $query = "INSERT INTO staff (staffID, staffPassword, staffName, staffPhoneNo, bcID) 
              VALUES ('$staffID', '$staffPassword', '$staffName', '$staffPhoneNo', '$bcID')";

    if (mysqli_query($condb, $query)) {
        echo "<script>
                alert('Staff added successfully.');
                window.location.href='staff_details.php';
              </script>";
    } else {
        echo "<script>
                alert('Error adding staff: " . mysqli_error($condb) . "');
                window.history.back();
              </script>";
    }
}

mysqli_close($condb);
?>
