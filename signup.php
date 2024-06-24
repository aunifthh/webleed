<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeBleed</title>
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
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li></li>
            </ul>
        </div>
    </nav>

    <header>
        <h1>WeBleed - Blood Donation Website</h1>
        <p>Become a Hero Today!</p>
    </header>

    <div class="form-section">
        <h2>Registration</h2>
        <form action="signup0.php" method="post">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" placeholder="(Eg: 1105)" required>
            </div>

            <div class="form-group">
                <label for="Name">Name:</label>
                <input type="text" name="name" placeholder="(Eg: Ali)" required>
            </div>

            <div class="form-group">
                <label for="Age">Age:</label>
                <input type="number" name="age" placeholder="(Eg: 24)" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="bloodtype">Blood Type:</label>
                <select id="bloodtype" name="bloodtype" required>
                    <option value="">Select Blood Type</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="O">O</option>
                    <option value="AB">AB</option>
                </select>
            </div>

            <div class="form-group">
                <label for="weight">Weight:</label>
                <input type="number" name="weight" placeholder="(Eg: 48)" required>
            </div>

            <div class="form-group">
                <label for="staff">Choose Staff:</label>
                <select id="staff" name="staff" required>
                    <option value="">Select Staff</option>
                    <?php
                    include('connection.php');
                    $staff_query = "SELECT staffID, staffName FROM staff";
                    $staff_result = mysqli_query($condb, $staff_query);

                    if ($staff_result && mysqli_num_rows($staff_result) > 0) {
                        while ($staff = mysqli_fetch_assoc($staff_result)) {
                            echo "<option value='" . $staff['staffID'] . "'>" . $staff['staffName'] . "</option>";
                        }
                    }

                    mysqli_close($condb);
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>
