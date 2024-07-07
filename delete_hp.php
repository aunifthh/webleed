<?php
session_start();
include('connection.php');

// Check if hpID is provided via POST parameter
if (isset($_POST['hpID'])) {
    $hpID = mysqli_real_escape_string($condb, $_POST['hpID']);

    // Delete healthcare provider from the database
    $delete_query = "DELETE FROM healthcareprovider WHERE hpID = '$hpID'";

    if (mysqli_query($condb, $delete_query)) {
        echo "<script>alert('Healthcare provider deleted successfully.'); window.location.href = 'hp_details.php';</script>";
    } else {
        echo "<script>alert('Error deleting healthcare provider: " . mysqli_error($condb) . "');</script>";
    }
} else if (isset($_GET['hpID'])) {
    $hpID = mysqli_real_escape_string($condb, $_GET['hpID']);
} else {
    echo "Invalid request.";
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
    <script>
        function confirmDelete(hpID) {
            if (confirm('Are you sure you want to delete this healthcare provider? This action cannot be undone.')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
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
    <div class="edit-section">
        <h2>Delete Healthcare Provider</h2><br>
        <form id="deleteForm" action="delete_hp.php" method="POST">
            <input type="hidden" name="hpID" value="<?php echo $hpID; ?>">
            <button type="button" onclick="confirmDelete('<?php echo $hpID; ?>')">Delete</button>
            <a href="hp_details.php" class="button">Cancel</a>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($condb);
?>
