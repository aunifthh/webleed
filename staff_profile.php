<?php
session_start();

// Check if the user is logged in as a donor
if (!isset($_SESSION['staffID'])) {
    // If not, redirect to login page
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch donor information from the database
$staffid = $_SESSION['staffID'];

$query = "SELECT * FROM staff WHERE staffID = '$staffid'";
$result = mysqli_query($condb, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $staff = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching staff data.";
    exit();
}

mysqli_close($condb);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeBleed</title>
    <link rel="icon" type="image/x-icon" href="logo.jpg">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo_item">
            <img src="logo.jpg" alt="Company Logo">
            <span>WeBleed</span>
        </div>
        <div class="navbar_content">
            <ul>
                <li><a href="home_staff.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li></li>
            </ul>
        </div>
    </nav>
    <div class="profile-container">
        <h2>Staff Profile</h2>
        <div class="profile-pic">
                <img src="nopfp.png" alt="Profile Picture">
        </div>
        <div class="profile-info">
            <p><strong>ID:</strong> <?php echo $staff['staffID']; ?></p>
            <p><strong>Name:</strong> <?php echo $staff['staffName']; ?></p>
            <p><strong>Phone Number:</strong> <?php echo $staff['staffPhoneNo']; ?></p>
        </div>
        <div class="profile-actions">
            <a href="staff_edit_profile.php" class="button">Edit Profile</a>
            <a href="staff_change_password.php" class="button">Change Password</a>
        </div>
    </div>

    <footer>
        <img src="bottom.png" alt="Footer Image">
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer>
</body>
</html>
