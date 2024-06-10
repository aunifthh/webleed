<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Sent</title>
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
        <h2>Message Sent!</h2>
        <p>Thank you for contacting us. We'll get back to you soon.</p>
        <a href="index.php" class="return-link">Return to Home</a>
    </div>
</body>

</html>
