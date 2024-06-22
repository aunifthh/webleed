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
                <li><a href="staff_details.php">Staff Details</a></li>
                <li><a href="staff_profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li></li>
            </ul>
        </div>
    </nav>
    <div class="edit-section">
        <h2>Add New Staff</h2>
        <form action="add_staff_process.php" method="POST">
            <div class="form-group">
                <label for="staffID">Staff ID:</label>
                <input type="text" id="staffID" name="staffID" required>
            </div>
            <div class="form-group">
                <label for="staffPassword">Password:</label>
                <input type="password" id="staffPassword" name="staffPassword" required>
            </div>
            <div class="form-group">
                <label for="staffName">Name:</label>
                <input type="text" id="staffName" name="staffName" required>
            </div>
            <div class="form-group">
                <label for="staffPhoneNo">Phone Number:</label>
                <input type="tel" id="staffPhoneNo" name="staffPhoneNo" required>
            </div>
            <div class="form-group">
                <label for="bcID">Blood Center:</label>
                <select id="bcID" name="bcID" required>
                    <option value="">Select a Blood Center</option>
                    <?php while($row = mysqli_fetch_assoc($bc_result)): ?>
                        <option value="<?php echo $row['bcID']; ?>"><?php echo $row['bcName']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit">Add Staff</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($condb);
?>
