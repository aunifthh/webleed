<?php
session_start();
include('../connection.php');

# Check if staff is logged in
if (!isset($_SESSION['staffid'])) {
    echo "<script>
            alert('You must be logged in as staff to access this page.');
            window.location.href='../index.php';
          </script>";
    exit();
}

# Retrieve donors without assigned staff
$sql_donors = "SELECT * FROM DONOR WHERE STAFFID IS NULL";
$result_donors = mysqli_query($condb, $sql_donors);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donor_id = mysqli_real_escape_string($condb, $_POST['donor_id']);
    $staff_id = $_SESSION['staffid'];

    $sql_assign = "UPDATE DONOR SET STAFFID = '$staff_id' WHERE DONID = '$donor_id'";
    if (mysqli_query($condb, $sql_assign)) {
        echo "<script>
                alert('Donor assigned successfully.');
                window.location.href='manage_donors.php';
              </script>";
    } else {
        echo "<script>
                alert('Assignment failed. Please try again.');
                window.history.back();
              </script>";
    }
}

mysqli_close($condb);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Donors</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="form-section">
        <h2>Manage Donors</h2>
        <form action="manage_donors.php" method="post">
            <div class="form-group">
                <label for="donor_id">Select Donor to Assign:</label>
                <select id="donor_id" name="donor_id" required>
                    <?php while ($donor = mysqli_fetch_assoc($result_donors)): ?>
                    <option value="<?php echo $donor['DONID']; ?>">
                        <?php echo $donor['DONNAME'] . ' (' . $donor['DONID'] . ')'; ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit">Assign Donor</button>
        </form>
        <a href="index.php" class="return-link">Return to Dashboard</a>
    </div>
</body>

</html>
