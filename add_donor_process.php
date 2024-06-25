<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donID = mysqli_real_escape_string($condb, $_POST['donID']);
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

    // Check if rewardID is set in $_POST
    if (isset($_POST['rewardID'])) {
        $rewardID = mysqli_real_escape_string($condb, $_POST['rewardID']);
    } else {
        $rewardID = null; // Set default value or handle error scenario
    }

    // Insert into donor table, with NULL value for rewardID if not provided
    $query = "INSERT INTO donor (donID, donPassword, donName, donGender, donAge, donPhoneNo, donBloodType, donBloodQty, donWeight, donFrequency, eligibleStatus, staffID, rewardID) 
              VALUES ('$donID', '$donPassword', '$donName', '$donGender', '$donAge', '$donPhoneNo', '$donBloodType', '$donBloodQty', '$donWeight', '$donFrequency', '$eligibleStatus', '$staffID', ";

    if (!empty($rewardID)) {
        // If rewardID is provided, include it in the INSERT statement
        $query .= "'$rewardID')";
    } else {
        // If rewardID is not provided, insert NULL
        $query .= "NULL)";
    }

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
