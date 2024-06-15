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
    <div class="logout-container">
        <?php
        session_start();

        if (isset($_POST['logout'])) {
            // Clear all session variables
            session_unset();
            // Destroy the session
            session_destroy();
            // Redirect to the login page or any other page
            header("Location: login.php");
            exit();
        }
        ?>

        <h3>Are you sure you want to log out?</h3>
        <div class="logout-actions">
        <form method="post">
                <button type="submit" name="logout">Yes</button>
                <button type="button" onclick="cancelLogout()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function cancelLogout() {
           window.history.back();
        }
    </script>
</body>
</html>
