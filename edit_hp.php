<?php
session_start();
include('connection.php');

// Fetch healthcare provider details from the database based on adminID passed in URL
if (isset($_GET['hpID'])) {
    $hpID = mysqli_real_escape_string($condb, $_GET['hpID']);
    
    $query = "SELECT hpID, hpPassword, sampleNo FROM healthcareprovider WHERE hpID = '$hpID'";
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
                <li><a href="home_admin.php">Home</a></li>
                <li><a href="admin_profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="edit-section">
        <h2>Edit Healthcare Provider</h2>
        <form action="edit_hp_process.php" method="POST">
            <input type="hidden" name="hpID" value="<?php echo $hp['hpID']; ?>">
            <div class="form-group">
                <label for="hpID">ID:</label>
                <input type="text" id="hpID" name="hpID" value="<?php echo $hp['hpID']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="hpPassword">Password:</label>
                <input type="password" id="hpPassword" name="hpPassword" value="<?php echo $hp['hpPassword']; ?>">
            </div>
            <div class="form-group">
                <label for="sampleNo">Sample No:</label>
                <input type="text" id="sampleNo" name="sampleNo" value="<?php echo $hp['sampleNo']; ?>">
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
