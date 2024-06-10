<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('wallpaper.png');
            background-size: cover;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            overflow: hidden;
            background-color: white;
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 15px 15px;
        }

        .navbar .left {
            display: flex;
            align-items: center;
        }

        .navbar .left img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar .left span {
            color: black;
            font-size: 20px;
            font-weight: bold;
        }

        .navbar a {
            color: black;
            text-align: center;
            padding: 20px 30px;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .form-section {
            max-width: 300px;
            margin: auto;
            padding: 40px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
            /* to avoid overlap with navbar */
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #DE252A;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #555;
        }

        .return-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
        }

        .return-link:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>
    <div class="navbar">
        <div class="left">
            <img src="logo.jpg" alt="Company Logo">
            <span>WeBleed</span>
        </div>
        <div>
            <a href="index.php">Home</a>
            <a href="process_registration.php">Sign Up</a>
        </div>
    </div>
    <div class="form-section">
        <h2>Login</h2>
        <form action="login_handler.php" method="post">
            <div class="form-group">
                <label for="login-username">Username:</label>
                <input type="text" id="login-username" name="login-username" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password:</label>
                <input type="password" id="login-password" name="login-password" required>
            </div>
            <div>
                <p><b>Login as:</b></p>
                <input type='radio' name='type' value='staff' checked>Staff<br>
                <input type='radio' name='type' value='donor'>Donor<br>
                <input type='radio' name='type' value='healthcareprovider'>Healthcare Provider<br>
                <br>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
