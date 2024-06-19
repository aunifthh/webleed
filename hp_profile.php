<?php
session_start();

// Check if the user is logged in as a healthcare provider
if (!isset($_SESSION['hpID'])) {
    // If not, redirect to login page
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch donor information from the database
$hpid = $_SESSION['hpID'];

$query = "SELECT * FROM healthcareprovider WHERE hpID = '$hpid'";
$result = mysqli_query($condb, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $hp = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching donor data.";
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
                <li><a href="home_hp.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li></li>
            </ul>
        </div>
    </nav>
    <div class="profile-container">
        <h2>Healthcare Provider Profile</h2>
        <div class="profile-pic">
                <img src="nopfp.png" alt="Profile Picture">
        </div>
        <div class="profile-info">
            <p><strong>ID:</strong> <?php echo $hp['hpID']; ?></p>
            <p><strong>Password:</strong> <?php echo $hp['hpPassword']; ?></p>
            <p><strong>Sample Number:</strong> <?php echo $hp['sampleNo']; ?></p>
        </div>
        <div class="profile-actions">
            <!--<a href="hp_edit_profile.php" class="button">Edit Profile</a> -->
            <a href="hp_change_password.php" class="button">Change Password</a>
        </div>
    </div>

    <footer>
        <img src="bottom.png" alt="Footer Image">
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer>
</body>
</html>
