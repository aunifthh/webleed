<?php
session_start();

// Check if the user is logged in as a donor
if (!isset($_SESSION['donID'])) {
    // If not, redirect to login page
    header("Location: login.php");
    exit();
}

include('connection.php');

// Fetch donor information from the database
$donid = $_SESSION['donID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the current password from the database
    $query = "SELECT donPassword FROM donor WHERE donID = '$donid'";
    $result = mysqli_query($condb, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $donor = mysqli_fetch_assoc($result);
        $stored_password = $donor['donPassword'];

        // Check if the current password matches the stored password
        if ($current_password == $stored_password) {
            // Check if the new password and confirm password match
            if ($new_password == $confirm_password) {
                // Update the password in the database
                $update_query = "UPDATE donor SET donPassword = '$new_password' WHERE donID = '$donid'";

                if (mysqli_query($condb, $update_query)) {
                    echo "<script>
                            alert('Password updated successfully.');
                            window.location.href = 'donor_profile.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Error updating password: " . mysqli_error($condb) . "');
                            window.history.back();
                          </script>";
                }
            } else {
                echo "<script>
                        alert('New password and confirm password do not match.');
                        window.history.back();
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Current password is incorrect.');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "Error fetching donor data.";
    }

    mysqli_close($condb);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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
                <li><a href="donor_profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="form-section">
        <h2>Change Password</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">Change Password</button>
        </form>
    </div>
</body>

</html>
