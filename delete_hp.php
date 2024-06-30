<?php
session_start();
include('connection.php');

// Check if staffID is provided via GET parameter
if (isset($_GET['staffID'])) {
    $staffID = mysqli_real_escape_string($condb, $_GET['staffID']);

    // Fetch healthcare provider details for confirmation
    $query = "SELECT staffID, staffName FROM staff WHERE staffID = '$staffID'";
    $result = mysqli_query($condb, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $hp = mysqli_fetch_assoc($result);
    } else {
        echo "Healthcare provider not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Healthcare Provider</title>
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
                <li><a href="home_admin.php">Home</a></li>
                <li><a href="admin_profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="confirmation-section">
        <h2>Delete Healthcare Provider</h2>
        <p>Are you sure you want to delete the healthcare provider <?php echo $hp['staffName']; ?> (ID: <?php echo $hp['staffID']; ?>)? This action cannot be undone.</p>
        <form action="delete_hp_process.php" method="POST">
            <input type="hidden" name="staffID" value="<?php echo $staffID; ?>">
            <button type="submit" name="delete">Delete</button>
            <a href="hp_details.php" class="button">Cancel</a>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($condb);
?>
