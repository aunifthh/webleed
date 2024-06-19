<?php
session_start();

// Check if the user is logged in as a healthcare provider
if (!isset($_SESSION['hpID'])) {
    // If not, redirect to login page
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch blood sample information from the database
$query = "SELECT * FROM bloodsample";
$result = mysqli_query($condb, $query);

if (!$result) {
    echo "Error fetching blood sample data.";
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
                <li><a href="home_hp.php">Home</a></li>
                <li><a href="hp_profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li></li>
            </ul>
        </div>
    </nav>

    <div class="blood-section">
        <h2>Blood Sample Information</h2>
        <table>
            <thead>
                <tr>
                    <th>Sample No</th>
                    <th>Blood Type</th>
                    <th>Status</th>
                    <th>Blood Center ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['sampleNo'] . "</td>";
                    echo "<td>" . $row['bloodType'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['bcID'] . "</td>";
                    echo "</tr>";
                }
                mysqli_free_result($result);
                mysqli_close($condb);
                ?>
            </tbody>
        </table>
    </div>
</body>
<footer>
        <img src="bottom.png" alt="Footer Image">
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer>
</html>
