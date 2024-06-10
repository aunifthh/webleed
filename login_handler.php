<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('wallpaper.png');
            background-size: cover;
            text-align: center;
        }

        .success-message {
            background-color: rgba(255, 255, 255, 0.8);
            /* Semi-transparent white background */
            color: #333;
            padding: 20px;
            border-radius: 5px;
            margin: 50px auto;
            width: 50%;
        }

        .return-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #45a049;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .return-link:hover {
            background-color: #4CAF50;
        }
    </style>
</head>

<body>
    <div class="success-message">
        <h2>Login Successful!</h2>
        <p>Welcome back to WeBleed</p>
        <a href="home_donor.php" class="return-link">Home Page</a>
    </div>
</body>

</html>