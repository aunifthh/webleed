<?php
session_start();

// Check if the user is logged in as a staff member
if (!isset($_SESSION['staffID'])) {
    // If not, redirect to login page
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch all staff information from the database
$query = "SELECT * FROM staff";
$result = mysqli_query($condb, $query);

// Handle form submissions for add, update, and delete
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_staff'])) {
        // Add new staff member
        $name = $_POST['name'];
        $phoneno = $_POST['phoneno'];
        $password = $_POST['password'];
        $add_query = "INSERT INTO staff (staffName, staffPhoneNo, staffPassword) VALUES ('$name', '$phoneno', '$password')";
        mysqli_query($condb, $add_query);
    } elseif (isset($_POST['update_staff'])) {
        // Update existing staff member
        $staffid = $_POST['staffid'];
        $name = $_POST['name'];
        $phoneno = $_POST['phoneno'];
        $update_query = "UPDATE staff SET staffName = '$name', staffPhoneNo = '$phoneno' WHERE staffID = '$staffid'";
        mysqli_query($condb, $update_query);
    } elseif (isset($_POST['delete_staff'])) {
        // Delete staff member
        $staffid = $_POST['staffid'];
        $delete_query = "DELETE FROM staff WHERE staffID = '$staffid'";
        mysqli_query($condb, $delete_query);
    }
    
    // Refresh the page to reflect the changes
    header("Location: staff_details.php");
    exit();
}

mysqli_close($condb);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeBleed - Staff Details</title>
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
    
        <h2>Staff Details</h2>

        <!-- Add New Staff Form -->
        <div class="edit-section">
            <h3>Add New Staff</h3>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phoneno">Phone Number:</label>
                    <input type="text" id="phoneno" name="phoneno" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="add_staff">Add Staff</button>
            </form>
        </div>

        <!-- Staff List Section -->
        <div class="staff-section">
            <h3>List of Staff</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['staffID']; ?></td>
                            <td><?php echo $row['staffName']; ?></td>
                            <td><?php echo $row['staffPhoneNo']; ?></td>
                            <td>
                                <!-- Edit Staff Form -->
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="display:inline;">
                                    <input type="hidden" name="staffid" value="<?php echo $row['staffID']; ?>">
                                    <input type="text" name="name" value="<?php echo $row['staffName']; ?>" required>
                                    <input type="text" name="phoneno" value="<?php echo $row['staffPhoneNo']; ?>" required>
                                    <button type="submit" name="update_staff">Update</button>
                                </form>
                                <!-- Delete Staff Form -->
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="display:inline;">
                                    <input type="hidden" name="staffid" value="<?php echo $row['staffID']; ?>">
                                    <button type="submit" name="delete_staff" onclick="return confirm('Are you sure you want to delete this staff member?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    

    <footer>
        <img src="bottom.png" alt="Footer Image">
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer>
</body>
</html>
