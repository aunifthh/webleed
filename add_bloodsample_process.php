<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bloodType = mysqli_real_escape_string($condb, $_POST['bloodType']);
    $status = mysqli_real_escape_string($condb, $_POST['status']);
    $bcID = mysqli_real_escape_string($condb, $_POST['bcID']);

    $query = "INSERT INTO bloodsample (bloodType, status, bcID) 
              VALUES ('$bloodType', '$status', '$bcID')";

    if (mysqli_query($condb, $query)) {
        echo "<script>
                alert('Blood sample added successfully.');
                window.location.href='bloodsample_details.php';
              </script>";
    } else {
        echo "<script>
                alert('Error adding blood sample: " . mysqli_error($condb) . "');
                window.history.back();
              </script>";
    }
}

mysqli_close($condb);
?>
