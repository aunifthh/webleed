<?php
session_start();

// Check if the user is logged in as a staff member
if (!isset($_SESSION['staffID'])) {
    // If not, redirect to login page
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch staff information from the database
$staffid = $_SESSION['staffID'];

$query = "SELECT * FROM staff WHERE staffID = '$staffid'";
$result = mysqli_query($condb, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $staff = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching staff data.";
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $phoneno = $_POST['phoneno'];

    // Update staff information in the database
    $update_query = "UPDATE staff SET staffName = '$name', staffPhoneNo = '$phoneno' WHERE staffID = '$staffid'";

    if (mysqli_query($condb, $update_query)) {

        echo "<script>
        alert('Profile updated successfully.'); 
        window.location.href = 'staff_profile.php';
        </script>";
    } else {
        echo "<script>
        alert('Error updating profile: " . mysqli_error($condb) . "');
      </script>";
    }

    mysqli_close($condb);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeBleed</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="logo.jpg">
</head>

<body>
    <nav class="navbar">
        <div class="logo_item">
            <img src="logo.jpg" alt="Company Logo">
            <span>WeBleed</span>
        </div>
        <div class="navbar_content">
            <ul>
                <li><a href="staff_profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li></li>
            </ul>
        </div>
    </nav>
    <div class="edit-section">
        <h2>Edit Profile</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($staff['staffName']); ?>">
            </div>
            <div class="form-group">
                <label for="phoneno">Phone Number:</label>
                <input type="text" id="phoneno" name="phoneno" value="<?php echo htmlspecialchars($staff['staffPhoneNo']); ?>">
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>

    <!--<footer>
        <img src="bottom.png" alt="Footer Image">
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer> -->
</body>

</html>