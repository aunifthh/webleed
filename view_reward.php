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

// Fetch reward information from the database
$query = "SELECT * FROM reward";
$result = mysqli_query($condb, $query);
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
<br>
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
    <br></br>
    <div class="details-section">
        <h2>Reward Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Reward ID</th>
                    <th>Reward Type</th>
                    <th>Reward Name</th>
                    <th>Reward Donation Frequency</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($reward = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $reward['rewardID'] . "</td>";
                        echo "<td>" . $reward['rewardType'] . "</td>";
                        echo "<td>" . $reward['rewardName'] . "</td>";
                        echo "<td>" . $reward['rewardDonFrequency'] . "</td>";
                        echo "<td>
                                <a href='reward_edit.php?rewardID=" . $reward['rewardID'] . "' class='button'>Edit</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No rewards found.</td></tr>";
                }

                mysqli_close($condb);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
