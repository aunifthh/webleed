<?php
session_start();

if (empty($_POST['id']) or empty($_POST['password']) or empty($_POST['type'])) {
    die("<script>
            alert('Please enter both username and password.');
            window.location.href='index.php';
        </script>");
}

include('connection.php');

if ($_POST['type'] == 'staff') {
    $table = "staff";
    $field1 = "staffid";
    $field2 = "staffpassword";
    $field3 = "staffname";
    $field4 = "staffphoneno";
    $location = "staff/index.php";
} else if ($_POST['type'] == 'donor') {
    $table = "donor";
    $field1 = "donid";
    $field2 = "donpassword";
    $field3 = "donname";
    $location = "home_donor.php";
} else if ($_POST['type'] == 'healthcareprovider') {
    $table = "healthcareprovider";
    $field1 = "hpid";
    $field2 = "hppassword";
    $location = "hp/index.php";
}

$id = mysqli_real_escape_string($condb, $_POST['id']);
$password = mysqli_real_escape_string($condb, $_POST['password']);

$sql_login = "SELECT * FROM $table WHERE $field1 = '$id' AND $field2 = '$password' LIMIT 1";
$result_login = mysqli_query($condb, $sql_login);

if (mysqli_num_rows($result_login) == 1) {
    $data = mysqli_fetch_array($result_login);
    $_SESSION[$field3] = $data[$field3];
    $_SESSION[$field1] = $data[$field1];

    echo "<script>
            alert('Welcome back, {$_POST['type']} ');
            window.location.href='$location';
            </script>";
} else {
    echo "<script>
            alert('Incorrect ID and Password');
            window.history.back();
        </script>";
}

mysqli_close($condb);
?>
