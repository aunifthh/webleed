<?php
session_start();
include('connection.php');

# Check if all required fields are set
if (!empty($_POST)) {

    # Retrieve and sanitize input data
    $id = mysqli_real_escape_string($condb, $_POST['id']);
    $name = mysqli_real_escape_string($condb, $_POST['name']);
    $age = mysqli_real_escape_string($condb, $_POST['age']);
    $gender = mysqli_real_escape_string($condb, $_POST['gender']);
    $bloodtype = mysqli_real_escape_string($condb, $_POST['bloodtype']);
    $weight = mysqli_real_escape_string($condb, $_POST['weight']);
    $password = mysqli_real_escape_string($condb, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($condb, $_POST['confirm-password']);

    # Check if passwords match
    if ($password != $confirm_password) {
        echo "<script>
                alert('Passwords do not match. Please try again.');
                window.history.back();
              </script>";
        exit();
    }


    # Check if the STAFFID exists in the STAFF table
    $staffid = 1; // Assign a valid STAFFID here based on your database

    $check_staffid_query = "SELECT * FROM staff WHERE staffID = '$staffid'";
    $check_staffid_result = mysqli_query($condb, $check_staffid_query);

    if (mysqli_num_rows($check_staffid_result) == 0) {
        echo "<script>
                alert('Invalid Staff ID. Please contact support.');
                window.history.back();
              </script>";
        exit();
    }

    # Insert donor data into the DONOR table
    $sql_insert = "INSERT INTO donor (donID, donPassword, donName, donGender, donAge, donBloodType, donWeight, donBloodQty, donFrequency, eligibleStatus, staffID)
                   VALUES ('$id', '$hashed_password', '$name', '$gender', '$age', '$bloodtype', '$weight', 0, 0, 'N', '$staffid')";

    if (mysqli_query($condb, $sql_insert)) {
        echo "<script>
                alert('Registration successful. You can now log in.');
                window.location.href='login.php';
              </script>";
    } else {
        echo "<script>
                alert('Sign up failed. Please try again.');
                window.history.back();
              </script>";
    }

} else {
    echo "<script>
            alert('Please fill in all required fields.');
            window.history.back();
          </script>";
}

mysqli_close($condb);
?>
