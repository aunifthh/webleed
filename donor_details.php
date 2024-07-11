<?php
session_start();

if (!isset($_SESSION['staffID']) && !isset($_SESSION['adminID'])) {
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch donor details from the database
$query = "SELECT donor.donIC, donor.donName, donor.donAge, donor.donPhoneNo, donor.donBloodType, donor.donBloodQty, donor.donWeight, donor.donFrequency, donor.eligibleStatus, bloodcenter.bcName 
          FROM donor 
          JOIN staff ON donor.staffID = staff.staffID 
          JOIN bloodcenter ON staff.bcID = bloodcenter.bcID";
$result = mysqli_query($condb, $query);

if (!$result) {
    die('Error fetching donor data: ' . mysqli_error($condb));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Details</title>
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
            </ul>
        </div>
    </nav>
    <div class="details-section">
        <h2>Donor List</h2>
        <a href="add_donor.php" class="button">Add New Donor</a>
        <table>
            <thead>
                <tr>
                    <th>Donor IC</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Phone Number</th>
                    <th>Blood Type</th>
                    <th>Blood Quantity</th>
                    <th>Weight</th>
                    <th>Donation Frequency</th>
                    <th>Eligibility Status</th>
                    <th>Blood Center</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['donIC']; ?></td>
                    <td><?php echo $row['donName']; ?></td>
                    <td><?php echo $row['donAge']; ?></td>
                    <td><?php echo $row['donPhoneNo']; ?></td>
                    <td><?php echo $row['donBloodType']; ?></td>
                    <td><?php echo $row['donBloodQty']; ?></td>
                    <td><?php echo $row['donWeight']; ?></td>
                    <td><?php echo $row['donFrequency']; ?></td>
                    <td><?php echo $row['eligibleStatus']; ?></td>
                    <td><?php echo $row['bcName']; ?></td>
                    <td>
                        <a href="edit_donor.php?donIC=<?php echo $row['donIC']; ?>" class="button">Edit</a>
                        <a href="delete_donor.php?id=<?php echo $row['donIC']; ?>" class="button" onclick="return confirm('Are you sure you want to delete this donor?');">Delete</a>
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
