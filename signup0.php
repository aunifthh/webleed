<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $bloodtype = $_POST['bloodtype'];
    $weight = $_POST['weight'];
    $staffID = $_POST['staff'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validate password and confirm password
    if ($password !== $confirm_password) {
        echo "<script>
                alert('Passwords do not match.');
                window.history.back();
              </script>";
        exit();
    }

    // Insert the new donor into the database
    $insert_query = "INSERT INTO donor (donID, donName, donAge, donGender, donWeight, donBloodType, donPassword, staffID) 
                     VALUES ('$id', '$name', '$age', '$gender', '$weight', '$bloodtype', '$password', '$staffID')";

    if (mysqli_query($condb, $insert_query)) {
        echo "<script>
                alert('Sign Up successfully.');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "<script>
                alert('Error during signup: " . mysqli_error($condb) . "');
                window.history.back();
              </script>";
    }

    mysqli_close($condb);
}
?>
