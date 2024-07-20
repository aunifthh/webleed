<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donIC = mysqli_real_escape_string($condb, $_POST['donIC']);
    $donName = mysqli_real_escape_string($condb, $_POST['donName']);
    $donAge = mysqli_real_escape_string($condb, $_POST['donAge']);
    $donPhoneNo = mysqli_real_escape_string($condb, $_POST['donPhoneNo']);
    $donWeight = mysqli_real_escape_string($condb, $_POST['donWeight']);
    $donBloodQty = mysqli_real_escape_string($condb, $_POST['donBloodQty']);
    $donFrequency = mysqli_real_escape_string($condb, $_POST['donFrequency']);
    $eligibleStatus = mysqli_real_escape_string($condb, $_POST['eligibleStatus']);
    $staffID = mysqli_real_escape_string($condb, $_POST['staffID']);


    $query = "UPDATE donor 
              SET donName='$donName', donAge='$donAge', donPhoneNo='$donPhoneNo', donWeight='$donWeight', 
                  donBloodQty='$donBloodQty', donFrequency='$donFrequency', eligibleStatus='$eligibleStatus', 
                  staffID='$staffID'
              WHERE donIC='$donIC'";

    if (mysqli_query($condb, $query)) {
        echo "<script>alert('Donor details updated successfully.'); window.location.href = 'donor_details.php';</script>";
    } else {
        echo "<script>alert('Error updating donor details: " . mysqli_error($condb) . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
}

mysqli_close($condb);
?>
