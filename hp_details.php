<?php
session_start();
include('connection.php');

// Fetch healthcare provider details from the database
$query = "SELECT hpID, hpPassword, sampleNo FROM healthcareprovider";
$result = mysqli_query($condb, $query);

if (!$result) {
    die('Error fetching healthcare provider data: ' . mysqli_error($condb));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Provider Details</title>
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
        <h2>Healthcare Provider List</h2>
        <a href="add_hp.php" class="button">Add New Healthcare Provider</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Password</th>
                    <th>Sample No</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['hpID']; ?></td>
                        <td><?php echo $row['hpPassword']; ?></td>
                        <td><?php echo $row['sampleNo']; ?></td>
                        <td>
                            <a href="edit_hp.php?hpID=<?php echo $row['hpID']; ?>" class="button">Edit</a>
                            <a href="delete_hp.php?hpID=<?php echo $row['hpID']; ?>" class="button delete-button" onclick="return confirm('Are you sure you want to delete this healthcare provider?');">Delete</a>
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
