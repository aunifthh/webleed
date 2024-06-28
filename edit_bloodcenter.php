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

// Fetch blood center details
if (isset($_GET['bcID'])) {
    $bcID = $_GET['bcID'];
    $query = "SELECT * FROM bloodcenter WHERE bcID = '$bcID'";
    $result = mysqli_query($condb, $query);

    if ($result) {
        $bloodcenter = mysqli_fetch_assoc($result);
    } else {
        die('Error fetching blood center data: ' . mysqli_error($condb));
    }
} else {
    die('No blood center ID specified.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeBleed - Edit Blood Center</title>
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
                <li><a href="bloodcenter_details.php">Blood Center Details</a></li>
                <li><a href="home_staff.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="edit-section">
        <h2>Edit Blood Center</h2>
        <form action="edit_bloodcenter_process.php" method="POST">
            <input type="hidden" name="bcID" value="<?php echo $bloodcenter['bcID']; ?>">
            <div class="form-group">
                <label for="bcName">Blood Center Name:</label>
                <input type="text" id="bcName" name="bcName" value="<?php echo $bloodcenter['bcName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="bcPhoneNo">Phone Number:</label>
                <input type="tel" id="bcPhoneNo" name="bcPhoneNo" value="<?php echo $bloodcenter['bcPhoneNo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="bcBloodQtyA">Blood Quantity Type A:</label>
                <div class="blood-qty-input">
                    <button type="button" onclick="decrementValue('bcBloodQtyA')">-</button>
                    <input type="number" id="bcBloodQtyA" name="bcBloodQtyA" min=0 value="<?php echo $bloodcenter['bcBloodQtyA']; ?>" required>
                    <button type="button" onclick="incrementValue('bcBloodQtyA')">+</button>
                </div>
            </div>
            <div class="form-group">
                <label for="bcBloodQtyB">Blood Quantity Type B:</label>
                <div class="blood-qty-input">
                    <button type="button" onclick="decrementValue('bcBloodQtyB')">-</button>
                    <input type="number" id="bcBloodQtyB" name="bcBloodQtyB" min=0 value="<?php echo $bloodcenter['bcBloodQtyB']; ?>" required>
                    <button type="button" onclick="incrementValue('bcBloodQtyB')">+</button>
                </div>
            </div>
            <div class="form-group">
                <label for="bcBloodQtyO">Blood Quantity Type O:</label>
                <div class="blood-qty-input">
                    <button type="button" onclick="decrementValue('bcBloodQtyO')">-</button>
                    <input type="number" id="bcBloodQtyO" name="bcBloodQtyO" min=0 value="<?php echo $bloodcenter['bcBloodQtyO']; ?>" required>
                    <button type="button" onclick="incrementValue('bcBloodQtyO')">+</button>
                </div>
            </div>
            <div class="form-group">
                <label for="bcBloodQtyAB">Blood Quantity Type AB:</label>
                <div class="blood-qty-input">
                    <button type="button" onclick="decrementValue('bcBloodQtyAB')">-</button>
                    <input type="number" id="bcBloodQtyAB" name="bcBloodQtyAB" min=0 value="<?php echo $bloodcenter['bcBloodQtyAB']; ?>" required>
                    <button type="button" onclick="incrementValue('bcBloodQtyAB')">+</button>
                </div>
            </div>
            <button type="submit">Update Blood Center</button>
        </form>
    </div>
    
    <script>
        function incrementValue(inputId) {
            var inputElement = document.getElementById(inputId);
            var currentValue = parseInt(inputElement.value);
            if (!isNaN(currentValue)) {
                inputElement.value = currentValue + 1;
            }
        }

        function decrementValue(inputId) {
            var inputElement = document.getElementById(inputId);
            var currentValue = parseInt(inputElement.value);
            if (!isNaN(currentValue) && currentValue > 0) {
                inputElement.value = currentValue - 1;
            }
        }
    </script>
</body>
</html>

<?php
mysqli_close($condb);
?>
