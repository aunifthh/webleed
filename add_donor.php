<?php
session_start();
include('connection.php');

// Fetch available blood centers
$bc_query = "SELECT bcID, bcName FROM bloodcenter";
$bc_result = mysqli_query($condb, $bc_query);

if (!$bc_result) {
    die('Error fetching blood centers: ' . mysqli_error($condb));
}

// Fetch available staff
$staff_query = "SELECT staffID, staffName FROM staff";
$staff_result = mysqli_query($condb, $staff_query);

if (!$staff_result) {
    die('Error fetching staff: ' . mysqli_error($condb));
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
            <label for="donID">Donor IC:</label>
            <input type="text" id="donIC" name="donIC" placeholder="Eg: 010203-04-0506" required>
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
                <option value="">Select Gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="donAge">Age:</label>
            <input type="number" id="donAge" name="donAge" required>
        </div>
        <div class="form-group">
            <label for="donPhoneNo">Phone Number:</label>
            <input type="text" id="donPhoneNo" name="donPhoneNo" placeholder="Eg: 0112345678" required>
        </div>
        <div class="form-group">
            <label for="donBloodType">Blood Type:</label>
            <select id="donBloodType" name="donBloodType" required>
                <option value="">Select Blood Type</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="O">O</option>
                <option value="AB">AB</option>
            </select>
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
                <option value="4">4 times a year</option>
            </select>
        </div>
        <div class="form-group">
            <label for="eligibleStatus">Eligible Status:</label>
            <select id="eligibleStatus" name="eligibleStatus" required>
                <option value="">Select Eligible Status</option>
                <option value="Y">Yes, eligible</option>
                <option value="N">No, not eligible</option>
            </select>
        </div>
        <div class="form-group">
            <label for="staffID">Staff Name:</label>
            <select id="staffID" name="staffID" required>
            <option value="">Select Staff</option>
                <?php while ($staff = mysqli_fetch_assoc($staff_result)): ?>
                    <option value="<?php echo $staff['staffID']; ?>">
                        <?php echo $staff['staffName']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit">Add Donor</button>
    </form>
</div>
</body>
</html>

<?php
mysqli_close($condb);
?>
