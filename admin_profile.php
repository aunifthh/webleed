<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['adminID'])) {
    // If not, redirect to login page
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch admin information from the database
$adminID = $_SESSION['adminID'];

$query = "SELECT * FROM admin WHERE adminID = '$adminID'";
$result = mysqli_query($condb, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $admin = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching admin data.";
    exit();
}

mysqli_close($condb);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
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
                <li><a href="home_admin.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li></li>
            </ul>
        </div>
    </nav>
    <div class="profile-container">
        <h2>Admin Profile</h2>
        <div class="profile-pic">
            <img src="nopfp.png" alt="Profile Picture">
        </div>
        <div class="profile-info">
            <p><strong>ID:</strong> <?php echo $admin['adminID']; ?></p>
            <p><strong>Password:</strong> ********</p>
        </div>
        <div class="profile-actions">
            <a href="admin_change_password.php" class="button">Change Password</a>
        </div>
    </div>

    <footer>
        <img src="bottom.png" alt="Footer Image">
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer>
</body>
</html>
