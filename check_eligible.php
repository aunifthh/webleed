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

$query = "SELECT * FROM donor WHERE donID = '$donid'";
$result = mysqli_query($condb, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $donor = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching donor data.";
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if ($donated == "no") {
        $lastDonation = date('Y-m-d', strtotime('-90 days'));
    }

    mysqli_close($condb);
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
            </ul>
        </div>
    </nav>

    <div class="edit-section">
        <h1>Blood Donation Eligibility Test</h1>
        <form id="eligibilityForm" method="POST" action="check_eligible.php">
            
            <label for="age">Age:</label>
            <span id="age"><?php echo htmlspecialchars($donor['donAge']); ?></span>

            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" value="<?php echo $donor['donWeight']; ?>" required><br><br>

            <label for="donated">Have you donated blood before? (in duration of this year)</label>
            <select id="donated" name="donated" required onchange="toggleLastDonation()">
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select><br><br>

            <label for="lastDonation">Last Donation Date:</label>
            <input type="date" id="lastDonation" name="lastDonation"><br><br>

            <label for="healthIssues">Do you have any serious health issues? (AIDS / Heart Disease / Anemia, other) :</label>
            <select id="healthIssues" name="healthIssues" required>
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select><br><br>

            <label for="pregnant">Are you a nursing mother, pregnant, or have recently given birth?</label>
            <select id="pregnant" name="pregnant" required>
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select><br><br>

            <button type="submit">Check Eligibility</button>
        </form>
        <div id="result"></div>
        <br><br>
    </div>

    <script src="eligible.js"></script>

    <script>
    function toggleLastDonation() {
        var donated = document.getElementById('donated').value;
        var lastDonation = document.getElementById('lastDonation');
        
        if (donated === 'no') {
            lastDonation.style.display = 'none';
            var today = new Date();
            today.setDate(today.getDate() - 90);
            var dateString = today.toISOString().split('T')[0];
            lastDonation.value = dateString;
        } else {
            lastDonation.style.display = 'block';
            lastDonation.value = '';
        }
    }

    // Initialize the form with the correct state
    document.addEventListener('DOMContentLoaded', function() {
        toggleLastDonation();
    });
    </script>

    <footer>
        <img src="bottom.png" alt="Footer Image">
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer>
</body>
</html>
