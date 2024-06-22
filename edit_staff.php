<?php
session_start();
include('connection.php');

if (!isset($_GET['staffID'])) {
    die('Invalid request');
}

$staffID = mysqli_real_escape_string($condb, $_GET['staffID']);
$query = "SELECT * FROM staff WHERE staffID='$staffID'";
$result = mysqli_query($condb, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die('Staff not found');
}

$staff = mysqli_fetch_assoc($result);

// Fetch available blood centers
$bc_query = "SELECT BCID, BCName FROM bloodcenter";
$bc_result = mysqli_query($condb, $bc_query);

if (!$bc_result) {
    die('Error fetching blood centers: ' . mysqli_error($condb));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="edit-section">
        <h2>Edit Staff Details</h2>
        <form action="edit_staff_process.php" method="POST">
            <input type="hidden" name="staffID" value="<?php echo $staff['staffID']; ?>">
            <div class="form-group">
                <label for="staffName">Name:</label>
                <input type="text" id="staffName" name="staffName" value="<?php echo $staff['staffName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="staffPhoneNo">Phone Number:</label>
                <input type="tel" id="staffPhoneNo" name="staffPhoneNo" value="<?php echo $staff['staffPhoneNo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="bcID">Blood Center:</label>
                <select id="bcID" name="bcID" required>
                    <?php while ($bc_row = mysqli_fetch_assoc($bc_result)): ?>
                        <option value="<?php echo $bc_row['BCID']; ?>" <?php if ($bc_row['BCID'] == $staff['BCID']) echo 'selected'; ?>>
                            <?php echo $bc_row['BCName']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit">Update Staff</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($condb);
?>
