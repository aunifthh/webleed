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

mysqli_close($condb);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeBleed - Add Blood Sample</title>
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
    <h2>Add New Blood Sample</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
            <label for="sampleNo">Sample No:</label>
            <input type="text" id="sampleNo" name="sampleNo" required>
        </div>
        <div class="form-group">
            <label for="bloodType">Blood Type:</label>
            <input type="text" id="bloodType" name="bloodType" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" required>
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
        <button type="submit">Add Blood Sample</button>
    </form>
</div>

</body>
</html>
