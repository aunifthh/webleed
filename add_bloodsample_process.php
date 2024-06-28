<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sampleNo = mysqli_real_escape_string($condb, $_POST['sampleNo']);
    $bloodType = mysqli_real_escape_string($condb, $_POST['bloodType']);
    $status = mysqli_real_escape_string($condb, $_POST['status']);
    $bcID = mysqli_real_escape_string($condb, $_POST['bcID']);

    // Check if sampleNo already exists in the database
    $check_query = "SELECT sampleNo FROM bloodsample WHERE sampleNo='$sampleNo'";
    $check_result = mysqli_query($condb, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Sample No already exists.');
                window.history.back();
              </script>";
        exit();
    }

    $query = "INSERT INTO bloodsample (sampleNo, bloodType, status, bcID) 
              VALUES ('$sampleNo', '$bloodType', '$status', '$bcID')";

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
