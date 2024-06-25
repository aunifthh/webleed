<?php
session_start();
include('connection.php');

// Fetch available blood centers
$bc_query = "SELECT bcID, bcName FROM bloodcenter";
$bc_result = mysqli_query($condb, $bc_query);

if (!$bc_result) {
    die('Error fetching blood centers: ' . mysqli_error($condb));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeBleed - Add New Donor</title>
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
            <li><a href="staff_profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="edit-section">
    <h2>Add New Donor</h2>
    <form action="add_donor_process.php" method="POST">
        <div class="form-group">
            <label for="donID">Donor ID:</label>
            <input type="text" id="donID" name="donID" required>
        </div>
        <div class="form-group">
            <label for="donPassword">Password:</label>
            <input type="password" id="donPassword" name="donPassword" required>
        </div>
        <div class="form-group">
            <label for="donName">Name:</label>
            <input type="text" id="donName" name="donName" required>
        </div>
        <div class="form-group">
            <label for="donGender">Gender:</label>
            <select id="donGender" name="donGender" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="donAge">Age:</label>
            <input type="number" id="donAge" name="donAge" required>
        </div>
        <div class="form-group">
            <label for="donBloodType">Blood Type:</label>
            <input type="text" id="donBloodType" name="donBloodType" required>
        </div>
        <div class="form-group">
            <label for="donBloodQty">Blood Quantity:</label>
            <input type="number" id="donBloodQty" name="donBloodQty" required>
        </div>
        <div class="form-group">
            <label for="donWeight">Weight:</label>
            <input type="number" id="donWeight" name="donWeight" required>
        </div>
        <div class="form-group">
            <label for="donFrequency">Donation Frequency:</label>
            <select id="donFrequency" name="donFrequency" required>
                <option value="0">Not specified</option>
                <option value="1">Once a year</option>
                <option value="2">Twice a year</option>
                <option value="3">Thrice a year</option>
            </select>
        </div>
        <div class="form-group">
            <label for="eligibleStatus">Eligible Status:</label>
            <input type="text" id="eligibleStatus" name="eligibleStatus" required>
        </div>
        <div class="form-group">
            <label for="staffID">Staff ID:</label>
            <input type="text" id="staffID" name="staffID" required>
        </div>
        <div class="form-group">
            <label for="rewardID">Reward ID:</label>
            <input type="text" id="rewardID" name="rewardID">
        </div>
        <button type="submit">Add Donor</button>
    </form>
</div>
</body>
</html>

<?php
mysqli_close($condb);
?>
