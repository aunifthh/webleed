<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sampleNo = mysqli_real_escape_string($condb, $_POST['sampleNo']);
    $bloodType = mysqli_real_escape_string($condb, $_POST['bloodType']);
    $status = mysqli_real_escape_string($condb, $_POST['status']);
    $bcID = mysqli_real_escape_string($condb, $_POST['bcID']);

    $query = "UPDATE bloodsample SET bloodType='$bloodType', status='$status', bcID='$bcID' WHERE sampleNo='$sampleNo'";

    if (mysqli_query($condb, $query)) {
        echo "<script>
                alert('Blood sample updated successfully.');
                window.location.href='bloodsample_details.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating blood sample: " . mysqli_error($condb) . "');
                window.history.back();
              </script>";
    }
}

mysqli_close($condb);
?>
