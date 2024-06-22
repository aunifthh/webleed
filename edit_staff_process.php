<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staffID = mysqli_real_escape_string($condb, $_POST['staffID']);
    $staffName = mysqli_real_escape_string($condb, $_POST['staffName']);
    $staffPhoneNo = mysqli_real_escape_string($condb, $_POST['staffPhoneNo']);
    $bcID = mysqli_real_escape_string($condb, $_POST['bcID']);

    $query = "UPDATE staff SET staffName='$staffName', staffPhoneNo='$staffPhoneNo', BCID='$bcID' WHERE staffID='$staffID'";

    if (mysqli_query($condb, $query)) {
        echo "<script>
                alert('Staff details have been updated successfully.');
                window.location.href='staff_details.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating staff details: " . mysqli_error($condb) . "');
                window.history.back();
              </script>";
    }
}

mysqli_close($condb);
?>
