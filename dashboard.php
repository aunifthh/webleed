<?php
// Initialize variables to store error messages
$usernameError = $passwordError = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform validation
    if (empty($username)) {
        $usernameError = "Username is required";
    }

    if (empty($password)) {
        $passwordError = "Password is required";
    }

    // If there are no errors, perform authentication
    if (empty($usernameError) && empty($passwordError)) {
        // Authenticate user (dummy authentication for demonstration)
        // Replace this with your actual authentication logic
        $validUsername = "user123";
        $validPassword = "password123";

        if ($username !== $validUsername || $password !== $validPassword) {
            $passwordError = "Invalid username or password";
        } else {
            // Redirect user to dashboard or another page upon successful login
            header("Location: dashboard.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeBleed</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="bloodimage-removebg-preview.png">
</head>

<body>
    <header>
        <img src="blooddonation.jpg" alt="Blood Donation" width="device-width" height="500">
        <h1>WeBleed - Blood Donation Website</h1>
        <p>Become a Hero Today!</p>
    </header>

    <main>
        <section id="login" class="form-section">
            <h2>Login</h2>
            <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    <span class="error"><?php echo $usernameError; ?></span> <!-- Display username error message -->
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <span class="error"><?php echo $passwordError; ?></span> <!-- Display password error message -->
                </div>
                <button type="submit">Login</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer>
</body>

</html>
