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
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
                <li></li>
            </ul>
        </div>
    </nav>

    <header>
        <h1>WeBleed - Blood Donation Website</h1>
        <p>Become a Hero Today!</p>
    </header>
    
    </div>
    <div class="form-section">
        <h2>Registration</h2>
        <form action="signup0.php" method="post">
            <div class="form-group">
                <label for="id">Username:</label>
                <input type="text" id="id" name="id" placeholder="(Eg: Ali5)" required>
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
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="bloodtype">Blood Type:</label>
                <select id="bloodtype" name="gender" required>
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
