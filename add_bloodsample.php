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

// Fetch blood center options for dropdown
$bc_query = "SELECT bcID, bcName FROM bloodcenter";
$bc_result = mysqli_query($condb, $bc_query);

if (!$bc_result) {
    die('Error fetching blood centers: ' . mysqli_error($condb));
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sampleNo = mysqli_real_escape_string($condb, $_POST['sampleNo']);
    $bloodType = mysqli_real_escape_string($condb, $_POST['bloodType']);
    $status = mysqli_real_escape_string($condb, $_POST['status']);
    $bcID = mysqli_real_escape_string($condb, $_POST['bcID']);

    // Check if the sampleNo already exists
    $check_query = "SELECT * FROM bloodsample WHERE sampleNo = '$sampleNo'";
    $check_result = mysqli_query($condb, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Sample number already exists. Please enter a unique sample number.');</script>";
    } else {
        $insert_query = "INSERT INTO bloodsample (sampleNo, bloodType, status, bcID) 
                         VALUES ('$sampleNo', '$bloodType', '$status', '$bcID')";

        if (mysqli_query($condb, $insert_query)) {
            echo "<script>alert('Blood sample added successfully.');</script>";
            mysqli_close($condb);
            header("Location: bloodsample_details.php");
            exit();
        } else {
            echo "<script>alert('Error adding blood sample: " . mysqli_error($condb) . "');</script>";
        }
    }
}

mysqli_close($condb);
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
            <li><a href="home_admin.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="edit-section">
    <h2>Add New Blood Sample</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
            <label for="sampleNo">Sample No:</label>
            <input type="text" id="sampleNo" name="sampleNo" placeholder="Eg: 4006"required>
        </div>
        <div class="form-group">
            <label for="bloodType">Blood Type:</label>
            <select id="bloodType" name="bloodType" required>
                <option value="">Select Blood Type</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="O">O</option>
                <option value="AB">AB</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="">Select Status</option>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>
        </div>
        <div class="form-group">
            <label for="bcID">Blood Center:</label>
            <select id="bcID" name="bcID" required>
                <option value="">Select a Blood Center</option>
                <?php while($row = mysqli_fetch_assoc($bc_result)): ?>
                    <option value="<?php echo htmlspecialchars($row['bcID']); ?>"><?php echo htmlspecialchars($row['bcName']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit">Add Blood Sample</button>
    </form>
</div>

</body>
</html>
