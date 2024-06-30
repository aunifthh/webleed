<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Healthcare Provider</title>
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
    <div class="form-container">
        <h2>Add New Healthcare Provider</h2>
        <form action="add_hp_process.php" method="POST">
            <div class="form-group">
                <label for="staffID">ID:</label>
                <input type="text" id="staffID" name="staffID" required>
            </div>
            <div class="form-group">
                <label for="staffPassword">Password:</label>
                <input type="password" id="staffPassword" name="staffPassword" required>
            </div>
            <div class="form-group">
                <label for="sampleNo">Sample No:</label>
                <input type="text" id="sampleNo" name="sampleNo" required>
            </div>
            <button type="submit">Add Healthcare Provider</button>
        </form>
    </div>
</body>
</html>
