<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('wallpaper.png');
            background-size: cover;
            margin: 0;
            /* Added to reset default margin */
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
            z-index: 1000;
            /* Ensure navbar stays on top */
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
            margin: 80px auto 20px;
            /* Adjusted margin-top to create space between navbar and form */
            padding: 40px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 108%;
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
            <a href="process_login.php">Login</a>
        </div>
    </div>
    <div class="form-section">
        <h2>Registration</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="id">ID:</label>
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
