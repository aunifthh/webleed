<?php
session_start();
include('connection.php');

// Fetch healthcare provider details from the database based on adminID passed in URL
if (isset($_GET['adminID'])) {
    $adminID = mysqli_real_escape_string($condb, $_GET['adminID']);
    
    $query = "SELECT staffID, staffPassword, bcID FROM staff WHERE staffID = '$adminID'";
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
    <title>Edit Healthcare Provider</title>
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
    <div class="form-container">
        <h2>Edit Healthcare Provider</h2>
        <form action="edit_hp_process.php" method="POST">
            <input type="hidden" name="original_staffID" value="<?php echo $hp['staffID']; ?>">
            <div class="form-group">
                <label for="staffID">ID:</label>
                <input type="text" id="staffID" name="staffID" value="<?php echo $hp['staffID']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="staffPassword">Password:</label>
                <input type="password" id="staffPassword" name="staffPassword" value="<?php echo $hp['staffPassword']; ?>">
            </div>
            <div class="form-group">
                <label for="bcID">Blood Center ID:</label>
                <input type="text" id="bcID" name="bcID" value="<?php echo $hp['bcID']; ?>">
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
