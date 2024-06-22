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

// Fetch staff information from the database
$query = "SELECT * FROM staff";
$result = mysqli_query($condb, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Details - WeBleed</title>
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
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="staff-section">
        <h2>Staff Details</h2>
        <a href="add_staff.php" class="button">Add New Staff</a>
        <table>
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Staff Name</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($staff = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $staff['staffID'] . "</td>";
                        echo "<td>" . $staff['staffName'] . "</td>";
                        echo "<td>" . $staff['staffPhoneNo'] . "</td>";
                        echo "<td>
                                <a href='edit_staff.php?id=" . $staff['staffID'] . "' class='button'>Edit</a>
                                <a href='delete_staff.php?id=" . $staff['staffID'] . "' class='button'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No staff members found.</td></tr>";
                }

                mysqli_close($condb);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
