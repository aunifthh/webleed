<?php
session_start();

// Check if the user is logged in as a staff member
if (!isset($_SESSION['staffID'])) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include the database connection file
include('connection.php');

// Fetch blood sample details
if (isset($_GET['sampleNo'])) {
    $sampleNo = $_GET['sampleNo'];
    $query = "SELECT * FROM bloodsample WHERE sampleNo = '$sampleNo'";
    $result = mysqli_query($condb, $query);

    if ($result) {
        $bloodsample = mysqli_fetch_assoc($result);
    } else {
        die('Error fetching blood sample data: ' . mysqli_error($condb));
    }
} else {
    die('No blood sample number specified.');
}

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
    <title>Edit Blood Sample</title>
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
                <li><a href="home_staff.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="edit-section">
        <h2>Edit Blood Sample</h2>
        <form action="edit_bloodsample_process.php" method="POST">
            <input type="hidden" name="sampleNo" value="<?php echo $bloodsample['sampleNo']; ?>">
            <div class="form-group">
                <label for="bloodType">Blood Type:</label>
                <input type="text" id="bloodType" name="bloodType" value="<?php echo $bloodsample['bloodType']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" id="status" name="status" value="<?php echo $bloodsample['status']; ?>" required>
            </div>
            <div class="form-group">
                <label for="bcID">Blood Center:</label>
                <select id="bcID" name="bcID" required>
                    <?php while ($row = mysqli_fetch_assoc($bc_result)): ?>
                        <option value="<?php echo $row['bcID']; ?>" <?php if ($row['bcID'] == $bloodsample['bcID']) echo 'selected'; ?>>
                            <?php echo $row['bcName']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit">Update Blood Sample</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($condb);
?>
