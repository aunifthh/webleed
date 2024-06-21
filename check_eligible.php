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
                <li><a href="home_donor.php">Home</a></li>
                <li><a href="donor_profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li></li>
            </ul>
        </div>
    </nav>

    <div class="edit-section">
        <h1>Blood Donation Eligibility Test</h1>
        <form id="eligibilityForm" method="POST" action="check_eligible.php">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo $donor['donAge']; ?>" required><br><br>

            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" value="<?php echo $donor['donWeight']; ?>" required><br><br>

            <label for="lastDonation">Last Donation Date:</label>
            <input type="date" id="lastDonation" name="lastDonation" required><br><br>

            <label for="healthIssues">Do you have any serious health issues? (AIDS / Heart Disease / Anemia, other) :</label>
            <select id="healthIssues" name="healthIssues" required>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>

            <label for="pregnant">Are you pregnant?</label>
            <select id="pregnant" name="pregnant" required>
                <option value="yes">Yes</option>    
                <option value="no">No</option>  
            </select>

            <br><br>
            <button type="submit">Check Eligibility</button>
        </form>
        <br><br>
        <div id="result"></div>
        <br><br>
    </div>

    <script src="eligible.js"></script>
    <footer>
        <img src="bottom.png" alt="Footer Image">
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer>
</body>
</html>
