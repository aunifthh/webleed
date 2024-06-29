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
                <li><a href="signup.php">Sign Up</a></li>
                <li></li>
            </ul>
        </div>
    </nav>
    <header>
        <!--<img src="donateblood.jpg" alt="Donate Blood">-->
        <h1>WeBleed - Blood Donation Website</h1>
        <p>Become a Hero Today!</p>
    </header>
    <div class="form-section">
        <h2>Login</h2>
        <form action="login0.php" method="post">
            <div class="form-group">
                <label for="id">IC/ID:</label>
                <input type="text" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="type">Login as:</label><br>
                <input type='radio' id='admin' name='type' value='admin' checked>Admin
                <br>
                <input type='radio' id='staff' name='type' value='staff' checked>Staff
                <br>
                
                <input type='radio' id='donor' name='type' value='donor'>Donor
                <br>
                
                <input type='radio' id='healthcareprovider' name='type' value='healthcareprovider'>Healthcare Provider
                
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    
</body>

</html>
