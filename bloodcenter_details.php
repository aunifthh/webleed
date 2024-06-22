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

// Fetch blood center information from the database
$query = "SELECT * FROM bloodcenter";
$result = mysqli_query($condb, $query);

// Process delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['bcID'])) {
    $bcID = $_GET['bcID'];
    $deleteQuery = "DELETE FROM bloodcenter WHERE bcID = '$bcID'";
    if (mysqli_query($condb, $deleteQuery)) {
        echo "<script>alert('Blood center deleted successfully.');</script>";
        header("Refresh:0; url=bloodcenter_details.php"); // Refresh page after deletion
        exit();
    } else {
        echo "<script>alert('Error deleting blood center: " . mysqli_error($condb) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeBleed - Blood Center Details</title>
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
    <h2>Blood Center Details</h2>
    <a href="add_bloodcenter.php" class="button">Add New Blood Center</a>
    <table>
        <thead>
        <tr>
            <th>Blood Center ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Blood Type A Quantity</th>
            <th>Blood Type B Quantity</th>
            <th>Blood Type O Quantity</th>
            <th>Blood Type AB Quantity</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['bcID'] . "</td>";
                echo "<td>" . $row['bcName'] . "</td>";
                echo "<td>" . $row['bcPhoneNo'] . "</td>";
                echo "<td>" . $row['bcBloodQtyA'] . "</td>";
                echo "<td>" . $row['bcBloodQtyB'] . "</td>";
                echo "<td>" . $row['bcBloodQtyO'] . "</td>";
                echo "<td>" . $row['bcBloodQtyAB'] . "</td>";
                echo "<td>
                        <a href='edit_bloodcenter.php?bcID=" . $row['bcID'] . "' class='button'>Edit</a>
                        <a href='bloodcenter_details.php?action=delete&bcID=" . $row['bcID'] . "' class='button' onclick=\"return confirm('Are you sure you want to delete this blood center?');\">Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No blood centers found.</td></tr>";
        }

        mysqli_close($condb);
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
