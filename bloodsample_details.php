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

// Fetch blood sample information from the database
$query = "SELECT * FROM bloodsample";
$result = mysqli_query($condb, $query);

// Function to get blood center name by bcID
function getBloodCenterName($condb, $bcID) {
    $bcQuery = "SELECT bcName FROM bloodcenter WHERE bcID = '$bcID'";
    $bcResult = mysqli_query($condb, $bcQuery);
    if ($bcResult && mysqli_num_rows($bcResult) > 0) {
        $bcRow = mysqli_fetch_assoc($bcResult);
        return $bcRow['bcName'];
    } else {
        return 'Unknown';
    }
}

// Process delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['sampleNo'])) {
    $sampleNo = $_GET['sampleNo'];
    $deleteQuery = "DELETE FROM bloodsample WHERE sampleNo = '$sampleNo'";
    if (mysqli_query($condb, $deleteQuery)) {
        echo "<script>alert('Blood sample deleted successfully.');</script>";
        header("Refresh:0; url=bloodsample_details.php"); // Refresh page after deletion
        exit();
    } else {
        echo "<script>alert('Error deleting blood sample: " . mysqli_error($condb) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeBleed - Blood Sample Details</title>
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

<div class="details-section">
    <h2>Blood Sample Details</h2>
    <a href="add_bloodsample.php" class="button">Add New Blood Sample</a>
    <table>
        <thead>
        <tr>
            <th>Sample No</th>
            <th>Blood Type</th>
            <th>Status</th>
            <th>Blood Center</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['sampleNo'] . "</td>";
                echo "<td>" . $row['bloodType'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . getBloodCenterName($condb, $row['bcID']) . "</td>";
                echo "<td>
                        <a href='edit_bloodsample.php?sampleNo=" . $row['sampleNo'] . "' class='button'>Edit</a>
                        <a href='bloodsample_details.php?action=delete&sampleNo=" . $row['sampleNo'] . "' class='button' onclick=\"return confirm('Are you sure you want to delete this blood sample?');\">Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No blood samples found.</td></tr>";
        }

        mysqli_close($condb);
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
