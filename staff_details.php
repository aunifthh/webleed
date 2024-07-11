<?php
session_start();

if (!isset($_SESSION['staffID']) && !isset($_SESSION['adminID'])) {
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch staff details from the database
$query = "SELECT staff.staffID, staff.staffName, staff.staffPhoneNo, bloodcenter.bcName 
          FROM staff 
          JOIN bloodcenter ON staff.bcID = bloodcenter.bcID";
$result = mysqli_query($condb, $query);

if (!$result) {
    die('Error fetching staff data: ' . mysqli_error($condb));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Details</title>
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
                <li></li>
            </ul>
        </div>
    </nav>
    <div class="details-section">
        <h2>Staff List</h2>
        <a href="add_staff.php" class="button">Add New Staff</a>
        <table>
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Blood Center</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['staffID']; ?></td>
                    <td><?php echo $row['staffName']; ?></td>
                    <td><?php echo $row['staffPhoneNo']; ?></td>
                    <td><?php echo $row['bcName']; ?></td>
                    <td>
                        <a href="edit_staff.php?staffID=<?php echo $row['staffID']; ?>" class="button">Edit</a>
                        <a href="delete_staff.php?id=<?php echo $row['staffID']; ?>" class="button delete-button" onclick="return confirm('Are you sure you want to delete this staff member?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
mysqli_close($condb);
?>
