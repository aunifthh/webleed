<?php
session_start();

// Check if the user is logged in as a donor
if (!isset($_SESSION['donID'])) {
    // If not, redirect to login page
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch donor information from the database
$donid = $_SESSION['donID'];

$query = "SELECT * FROM donor WHERE donID = '$donid'";
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
                <li><a href="home_donor.php">Home</a></li>
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
            <p><strong>ID:</strong> <?php echo $donor['donID']; ?></p>
            <p><strong>Name:</strong> <?php echo $donor['donName']; ?></p>
            <p><strong>Age:</strong> <?php echo $donor['donAge']; ?></p>
            <p><strong>Gender:</strong> 
            <?php
            if ($donor['donGender'] == 'M') {
                echo 'Male';
            } elseif ($donor['donGender'] == 'F') {
                echo 'Female';
            }
            ?>
            </p>
            <p><strong>Weight:</strong> <?php echo $donor['donWeight']; ?></p>
            <!--<p><strong>Phone Number:</strong> <?php echo $donor['donPhoneNo']; ?></p> -->
            <p><strong>Eligible status:</strong> <!--<?php echo $donor['eligibleStatus']; ?> -->
           
            <?php
            if ($donor['eligibleStatus'] == 'Y') {
                echo 'Eligible';
            } 
            else if ($donor['eligibleStatus'] == null) { // fixed here
                echo 'Do Eligible Test';
            }
            else if ($donor['eligibleStatus'] == 'N') {
                echo 'Not Eligible';
            }
            ?>

            <p><strong>Blood Type:</strong> <?php echo $donor['donBloodType']; ?></p>
            <p><strong>Blood Quantity:</strong> <?php echo $donor['donBloodQty']; ?></p>
            <p><strong>Blood Donation Frequency:</strong> <?php echo $donor['donFrequency']; ?></p>
        </div>
        <div class="profile-actions">
            <a href="donor_edit_profile.php" class="button">Edit Profile</a>
            <a href="donor_change_password.php" class="button">Change Password</a>
        </div>
    </div>

    <div class = "profile-container">
        <h2> Claimable Reward !</h2>
        <?php
            if ($donor['donFrequency'] == 0) {
                echo 'No Rewards';
            } 
            else if ($donor['donFrequency'] == 1) {
                echo 'Free 1 outpatient treatment and 1 medical treatment';
            } 
            else if ($donor['donFrequency'] == 2) {
                echo 'Free 1 outpatient treatment and 2nd class wards for a period of 4 months';
            } 
            else if ($donor['donFrequency'] == 3) {
                echo 'Free 3 outpatient treatment and 2nd class medical treatment for a 6 month period';
            } 
            else if ($donor['donFrequency'] == 4) {
                echo 'Free 1 year outpatient treatment, free Influenza Vaccine and 2nd class medical treatment for a 8 month period';
            } 
            ?>

    </div>

    <footer>
        <img src="bottom.png" alt="Footer Image">
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer>
</body>
</html>
