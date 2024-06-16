<?php
session_start();

// Check if the user is logged in as a donor
if (!isset($_SESSION['donid'])) {
    // If not, redirect to login page
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch donor information from the database
$donid = $_SESSION['donid'];

$query = "SELECT * FROM donor WHERE donid = '$donid'";
$result = mysqli_query($condb, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $donor = mysqli_fetch_assoc($result);
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
                <li><a href="index.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li></li>
            </ul>
        </div>
    </nav>
    <div class="profile-container">
        <h2>Donor Profile</h2>
        <div class="profile-pic">
                <img src="nopfp.png" alt="Profile Picture">
        </div>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo $donor['donid']; ?></p>
            <p><strong>Name:</strong> <?php echo $donor['donname']; ?></p>
            <p><strong>Age:</strong> <?php echo $donor['donage']; ?></p>
            <p><strong>Gender:</strong> 
            <?php
            if ($donor['dongender'] == 'M') {
                echo 'Male';
            } elseif ($donor['dongender'] == 'F') {
                echo 'Female';
            }
            ?>
            </p>
            <p><strong>Weight:</strong> <?php echo $donor['donweight']; ?></p>
            <!--<p><strong>Phone Number:</strong> <?php echo $donor['donphoneno']; ?></p> -->
            <p><strong>Eligible status:</strong>
            <?php
            if ($donor['eligiblestatus'] == 'Y') {
                echo 'Eligible';
            } elseif ($donor['eligiblestatus' == 'N']) {
                echo 'Not Eligible';
            }
            ?>
            <p><strong>Blood Type:</strong> <?php echo $donor['donbloodtype']; ?></p>
            <p><strong>Blood Quantity:</strong> <?php echo $donor['donbloodqty']; ?></p>
            <p><strong>Blood Donation Frequency:</strong> <?php echo $donor['donfrequency']; ?></p>
        </div>
        <div class="profile-actions">
            <a href="donor_edit_profile.php" class="button">Edit Profile</a>
            <a href="donor_change_password.php" class="button">Change Password</a>
        </div>
    </div>

    <footer>
        <img src="bottom.png" alt="Footer Image">
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer>
</body>
</html>
