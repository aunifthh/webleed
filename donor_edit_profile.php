<?php
session_start();

// Check if the user is logged in as a donor
if (!isset($_SESSION['donid'])) {
    // If not, redirect to login page
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch donor information from the database
$donid = $_SESSION['donid'];

$query = "SELECT * FROM donor WHERE donid = '$donid'";
$result = mysqli_query($condb, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $donor = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching donor data.";
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $weight = $_POST['weight'];
    $bloodtype = $_POST['bloodtype'];
    $bloodqty = $_POST['bloodqty'];
    $frequency = $_POST['frequency'];

    // Update donor information in the database
    $update_query = "UPDATE donor SET donname = '$name', donage = '$age', dongender = '$gender', 
                    donweight = '$weight', donbloodtype = '$bloodtype', donbloodqty = '$bloodqty', 
                    donfrequency = '$frequency' WHERE donid = '$donid'";

    if (mysqli_query($condb, $update_query)) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . mysqli_error($condb);
    }

    mysqli_close($condb);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
                <li><a href="index.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="form-section">
        <h2>Edit Profile</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $donor['donname']; ?>">
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" id="age" name="age" value="<?php echo $donor['donage']; ?>">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="M" <?php if ($donor['dongender'] == 'M') echo 'selected'; ?>>Male</option>
                    <option value="F" <?php if ($donor['dongender'] == 'F') echo 'selected'; ?>>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="weight">Weight:</label>
                <input type="text" id="weight" name="weight" value="<?php echo $donor['donweight']; ?>">
            </div>
            <div class="form-group">
                <label for="bloodtype">Blood Type:</label>
                <input type="text" id="bloodtype" name="bloodtype" value="<?php echo $donor['donbloodtype']; ?>">
            </div>
            <div class="form-group">
                <label for="bloodqty">Blood Quantity:</label>
                <input type="text" id="bloodqty" name="bloodqty" value="<?php echo $donor['donbloodqty']; ?>">
            </div>
            <div class="form-group">
                <label for="frequency">Donation Frequency:</label>
                <input type="text" id="frequency" name="frequency" value="<?php echo $donor['donfrequency']; ?>">
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>

</html>
