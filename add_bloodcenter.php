<?php
session_start();

// Check if the user is logged in as a staff member
if (!isset($_SESSION['staffID'])) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blood Center</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="logo.jpg">
    <script>
        function incrementValue(inputId) {
            var input = document.getElementById(inputId);
            var value = parseInt(input.value);
            value = isNaN(value) ? 0 : value;
            value++;
            input.value = value;
        }

        function decrementValue(inputId) {
            var input = document.getElementById(inputId);
            var value = parseInt(input.value);
            value = isNaN(value) ? 0 : value;
            if (value > 0) { // Ensure the value does not go below zero
                value--;
            }
            input.value = value;
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
                <li><a href="bloodcenter_details.php">Blood Center Details</a></li>
                <li><a href="home_staff.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="edit-section">
        <h2>Add Blood Center</h2>
        <form action="add_bloodcenter_process.php" method="POST">
            <div class="form-group">
                <label for="bcID">Blood Center ID:</label>
                <input type="text" id="bcID" name="bcID" required>
            </div>
            <div class="form-group">
                <label for="bcName">Blood Center Name:</label>
                <input type="text" id="bcName" name="bcName" required>
            </div>
            <div class="form-group">
                <label for="bcPhoneNo">Phone Number:</label>
                <input type="tel" id="bcPhoneNo" name="bcPhoneNo" required>
            </div>
            <div class="form-group">
                <label for="bcBloodQtyA">Blood Quantity Type A:</label>
                <div class="quantity-container">
                    <button type="button" onclick="decrementValue('bcBloodQtyA')">-</button>
                    <input type="number" id="bcBloodQtyA" name="bcBloodQtyA" value="0" min="0" required>
                    <button type="button" onclick="incrementValue('bcBloodQtyA')">+</button>
                </div>
            </div>
            <div class="form-group">
                <label for="bcBloodQtyB">Blood Quantity Type B:</label>
                <div class="quantity-container">
                    <button type="button" onclick="decrementValue('bcBloodQtyB')">-</button>
                    <input type="number" id="bcBloodQtyB" name="bcBloodQtyB" value="0" min="0" required>
                    <button type="button" onclick="incrementValue('bcBloodQtyB')">+</button>
                </div>
            </div>
            <div class="form-group">
                <label for="bcBloodQtyO">Blood Quantity Type O:</label>
                <div class="quantity-container">
                    <button type="button" onclick="decrementValue('bcBloodQtyO')">-</button>
                    <input type="number" id="bcBloodQtyO" name="bcBloodQtyO" value="0" min="0" required>
                    <button type="button" onclick="incrementValue('bcBloodQtyO')">+</button>
                </div>
            </div>
            <div class="form-group">
                <label for="bcBloodQtyAB">Blood Quantity Type AB:</label>
                <div class="quantity-container">
                    <button type="button" onclick="decrementValue('bcBloodQtyAB')">-</button>
                    <input type="number" id="bcBloodQtyAB" name="bcBloodQtyAB" value="0" min="0" required>
                    <button type="button" onclick="incrementValue('bcBloodQtyAB')">+</button>
                </div>
            </div>
            <button type="submit">Add Blood Center</button>
        </form>
    </div>
</body>
</html>
