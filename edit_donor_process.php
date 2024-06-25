<?php
session_start();
include('connection.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donID = mysqli_real_escape_string($condb, $_POST['donID']);
    $donName = mysqli_real_escape_string($condb, $_POST['donName']);
    $donAge = mysqli_real_escape_string($condb, $_POST['donAge']);
    $donPhoneNo = mysqli_real_escape_string($condb, $_POST['donPhoneNo']);
    $donWeight = mysqli_real_escape_string($condb, $_POST['donWeight']);
    $donBloodType = mysqli_real_escape_string($condb, $_POST['donBloodType']);
    $donBloodQty = mysqli_real_escape_string($condb, $_POST['donBloodQty']);
    $donFrequency = mysqli_real_escape_string($condb, $_POST['donFrequency']);
    $eligibleStatus = mysqli_real_escape_string($condb, $_POST['eligibleStatus']);
    $staffID = mysqli_real_escape_string($condb, $_POST['staffID']);
    

    $query = "UPDATE donor SET 
              donName='$donName', 
              donAge='$donAge', 
              donPhoneNo = '$donPhoneNo',
              donWeight='$donWeight',
              donBloodType='$donBloodType',
              donBloodQty='$donBloodQty',
              donFrequency='$donFrequency',
              eligibleStatus='$eligibleStatus',
              staffID='$staffID'
              WHERE donID='$donID'";

    if (mysqli_query($condb, $query)) {
        echo "<script>
                alert('Donor details have been updated successfully.');
                window.location.href='donor_details.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating donor details: " . mysqli_error($condb) . "');
                window.history.back();
              </script>";
    }
}

mysqli_close($condb);
?>
