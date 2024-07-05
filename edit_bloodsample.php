<?php
session_start();

// Check if the user is logged in as a staff member
if (!isset($_SESSION['adminID'])) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include the database connection file
include('connection.php');

// Fetch blood sample details
if (isset($_GET['sampleNo'])) {
    $sampleNo = mysqli_real_escape_string($condb, $_GET['sampleNo']);
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
                <li><a href="bloodsample_details.php">Blood Sample Details</a></li>
                <li><a href="home_staff.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="edit-section">
        <h2>Edit Blood Sample</h2>
        <form action="edit_bloodsample_process.php" method="POST">
            <input type="hidden" name="sampleNo" value="<?php echo htmlspecialchars($bloodsample['sampleNo']); ?>">
            <div class="form-group">
                <label for="bloodType">Blood Type:</label>
                <select id="bloodType" name="bloodType" required>
                    <option value="">Select Blood Type</option>
                    <option value="A" <?php if ($bloodsample['bloodType'] == 'A') echo 'selected'; ?>>A</option>
                    <option value="B" <?php if ($bloodsample['bloodType'] == 'B') echo 'selected'; ?>>B</option>
                    <option value="O" <?php if ($bloodsample['bloodType'] == 'O') echo 'selected'; ?>>O</option>
                    <option value="AB" <?php if ($bloodsample['bloodType'] == 'AB') echo 'selected'; ?>>AB</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="Available" <?php if ($bloodsample['status'] == 'Available') echo 'selected'; ?>>Available</option>
                    <option value="Unavailable" <?php if ($bloodsample['status'] == 'Unavailable') echo 'selected'; ?>>Unavailable</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bcID">Blood Center:</label>
                <select id="bcID" name="bcID" required>
                    <option value="">Select a Blood Center</option>
                    <?php while ($row = mysqli_fetch_assoc($bc_result)): ?>
                        <option value="<?php echo htmlspecialchars($row['bcID']); ?>" <?php if ($row['bcID'] == $bloodsample['bcID']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($row['bcName']); ?>
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
