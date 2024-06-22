<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bcID = mysqli_real_escape_string($condb, $_POST['bcID']);
    $bcName = mysqli_real_escape_string($condb, $_POST['bcName']);
    $bcPhoneNo = mysqli_real_escape_string($condb, $_POST['bcPhoneNo']);
    $bcBloodQtyA = mysqli_real_escape_string($condb, $_POST['bcBloodQtyA']);
    $bcBloodQtyB = mysqli_real_escape_string($condb, $_POST['bcBloodQtyB']);
    $bcBloodQtyO = mysqli_real_escape_string($condb, $_POST['bcBloodQtyO']);
    $bcBloodQtyAB = mysqli_real_escape_string($condb, $_POST['bcBloodQtyAB']);

    $query = "UPDATE bloodcenter SET 
                bcName='$bcName', 
                bcPhoneNo='$bcPhoneNo', 
                bcBloodQtyA='$bcBloodQtyA', 
                bcBloodQtyB='$bcBloodQtyB', 
                bcBloodQtyO='$bcBloodQtyO', 
                bcBloodQtyAB='$bcBloodQtyAB' 
              WHERE bcID='$bcID'";

    if (mysqli_query($condb, $query)) {
        echo "<script>
                alert('Blood center updated successfully.');
                window.location.href='bloodcenter_details.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating blood center: " . mysqli_error($condb) . "');
                window.history.back();
              </script>";
    }
}

mysqli_close($condb);
?>
