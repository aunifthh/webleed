<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donIC = mysqli_real_escape_string($condb, $_POST['donIC']);
    $donPassword = mysqli_real_escape_string($condb, $_POST['donPassword']);
    $donName = mysqli_real_escape_string($condb, $_POST['donName']);
    $donGender = mysqli_real_escape_string($condb, $_POST['donGender']);
    $donAge = mysqli_real_escape_string($condb, $_POST['donAge']);
    $donPhoneNo = mysqli_real_escape_string($condb, $_POST['donPhoneNo']);
    $donBloodType = mysqli_real_escape_string($condb, $_POST['donBloodType']);
    $donBloodQty = mysqli_real_escape_string($condb, $_POST['donBloodQty']);
    $donWeight = mysqli_real_escape_string($condb, $_POST['donWeight']);
    $donFrequency = mysqli_real_escape_string($condb, $_POST['donFrequency']);
    $eligibleStatus = mysqli_real_escape_string($condb, $_POST['eligibleStatus']);
    $staffID = mysqli_real_escape_string($condb, $_POST['staffID']);

    // Check if donID already exists in the database
    $check_query = "SELECT donIC FROM donor WHERE donIC='$donIC'";
    $check_result = mysqli_query($condb, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Donor ID already exists.');
                window.history.back();
              </script>";
        exit();
    }

    // Insert into donor table
    $query = "INSERT INTO donor (donIC, donPassword, donName, donGender, donAge, donPhoneNo, donBloodType, donBloodQty, donWeight, donFrequency, eligibleStatus, staffID) 
              VALUES ('$donIC', '$donPassword', '$donName', '$donGender', '$donAge', '$donPhoneNo', '$donBloodType', '$donBloodQty', '$donWeight', '$donFrequency', '$eligibleStatus', '$staffID')";

    if (mysqli_query($condb, $query)) {
        echo "<script>
                alert('Donor added successfully.');
                window.location.href='donor_details.php';
              </script>";
    } else {
        echo "<script>
                alert('Error adding donor: " . mysqli_error($condb) . "');
                window.history.back();
              </script>";
    }
}

mysqli_close($condb);
?>
