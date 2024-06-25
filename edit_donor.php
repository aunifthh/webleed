<?php
session_start();
include('connection.php');

// Check if donID is set and fetch donor details
if (!isset($_GET['donID'])) {
    die('Invalid request');
}

$donID = mysqli_real_escape_string($condb, $_GET['donID']);
$query = "SELECT * FROM donor WHERE donID='$donID'";
$result = mysqli_query($condb, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die('Donor not found');
}

$donor = mysqli_fetch_assoc($result);

// Fetch staff IDs for selection
$staff_query = "SELECT staffID, staffName FROM staff";
$staff_result = mysqli_query($condb, $staff_query);

if (!$staff_result) {
    die('Error fetching staff IDs: ' . mysqli_error($condb));
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
            <li><a href="donor_details.php">Donor Details</a></li>
            <li><a href="donor_profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="edit-section">
    <h2>Edit Donor Details</h2>
    <form action="edit_donor_process.php" method="POST">
        <input type="hidden" name="donID" value="<?php echo $donor['donID']; ?>">
        <div class="form-group">
            <label for="donName">Name:</label>
            <input type="text" id="donName" name="donName" value="<?php echo $donor['donName']; ?>">
        </div>
        <div class="form-group">
            <label for="donAge">Age:</label>
            <input type="number" id="donAge" name="donAge" value="<?php echo $donor['donAge']; ?>">
        </div>
        <div class="form-group">
            <label for="donPhoneNo">Phone Number:</label>
            <input type="text" id="donPhoneNo" name="donPhoneNo" value="<?php echo $donor['donPhoneNo']; ?>">
        </div>
        <div class="form-group">
            <label for="donWeight">Weight:</label>
            <input type="number" id="donWeight" name="donWeight" value="<?php echo $donor['donWeight']; ?>">
        </div>
        <div class="form-group">
            <label for="donBloodType">Blood Type:</label>
            <input type="text" id="donBloodType" name="donBloodType" value="<?php echo $donor['donBloodType']; ?>">
        </div>
        <div class="form-group">
            <label for="donBloodQty">Blood Quantity:</label>
            <input type="number" id="donBloodQty" name="donBloodQty" value="<?php echo $donor['donBloodQty']; ?>">
        </div>
        <div class="form-group">
            <label for="donFrequency">Donation Frequency:</label>
            <input type="number" id="donFrequency" name="donFrequency" value="<?php echo $donor['donFrequency']; ?>">
        </div>
        <div class="form-group">
            <label for="eligibleStatus">Eligible Status:</label>
            <input type="text" id="eligibleStatus" name="eligibleStatus" placeholder="Y: Yes, eligible  N: Not eligible" value="<?php echo $donor['eligibleStatus']; ?>">
        </div>
        <div class="form-group">
            <label for="staffID">Staff ID:</label>
            <select id="staffID" name="staffID" required>
                <?php while ($staff = mysqli_fetch_assoc($staff_result)): ?>
                    <option value="<?php echo $staff['staffID']; ?>" <?php if ($staff['staffID'] == $donor['staffID']) echo 'selected'; ?>>
                        <?php echo $staff['staffName']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit">Update Donor</button>
    </form>
</div>
</body>
</html>

<?php
mysqli_close($condb);
?>
