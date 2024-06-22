<?php
session_start();
include('connection.php');

if (!isset($_GET['rewardID'])) {
    die('Invalid request');
}

$rewardID = mysqli_real_escape_string($condb, $_GET['rewardID']);
$query = "SELECT * FROM reward WHERE rewardID='$rewardID'";
$result = mysqli_query($condb, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die('Reward not found');
}

$reward = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rewardType = mysqli_real_escape_string($condb, $_POST['rewardType']);
    $rewardName = mysqli_real_escape_string($condb, $_POST['rewardName']);
    $rewardDonFrequency = mysqli_real_escape_string($condb, $_POST['rewardDonFrequency']);

    $update_query = "UPDATE reward SET rewardType='$rewardType', rewardName='$rewardName', rewardDonFrequency='$rewardDonFrequency' WHERE rewardID='$rewardID'";
    if (mysqli_query($condb, $update_query)) {
        echo "Reward updated successfully";
        header("Location: view_reward.php");
        exit();
    } else {
        echo "Error updating reward: " . mysqli_error($condb);
    }
}

mysqli_close($condb);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reward Details</title>
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
                <li><a href="home_staff.php">Home</a></li>
                <li><a href="staff_profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li></li>
            </ul>
        </div>
    </nav>
    <div class="edit-section">
        <h2>Edit Reward Details</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="rewardType">Reward Type:</label>
                <input type="number" id="rewardType" name="rewardType" value="<?php echo $reward['rewardType']; ?>" required>
            </div>
            <div class="form-group">
                <label for="rewardName">Reward Name:</label>
                <input type="text" id="rewardName" name="rewardName" value="<?php echo $reward['rewardName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="rewardDonFrequency">Reward Donation Frequency:</label>
                <input type="number" id="rewardDonFrequency" name="rewardDonFrequency" value="<?php echo $reward['rewardDonFrequency']; ?>" required>
            </div>
            <button type="submit">Update Reward</button>
        </form>
    </div>
</body>
</html>
