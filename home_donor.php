<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeBleed</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            color: #333;
        }

        header {
            text-align: center;
            padding-top: 80px;
            /* Ensure content is pushed below navbar */
        }

        header img {
            width: 70%;
            height: auto;
        }

        header h1 {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 2em;
        }

        header p {
            margin-bottom: 20px;
        }

        main {
            padding: 20px;
        }

        .form-section {
            width: 80%;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
        }

        .form-section h2 {
            color: #c0392b;
        }

        .registration-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .registration-link:hover {
            background-color: #45a049;
        }

        .reward {
            text-align: center;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: center;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            background-color: #f2f2f2;
            color: #333;
            text-align: center;
        }

        footer {
            background-color: #c0392b;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        footer img {
            width: 100%;
            height: auto;
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

    </style>
</head>

<body>
    <div class="navbar">
        <div class="left">
            <img src="logo.jpg" alt="Company Logo">
            <span>WeBleed</span>
        </div>
        <div>
            <a href="#">Profile</a>
            <a href="#">Logout</a>
        </div>
    </div>

    <header>
        <img src="donateblood.jpg" alt="Donate Blood">
        <h1>WeBleed - Blood Donation Website</h1>
        <p>Become a Hero Today!</p>
    </header>

    <main>
        <section class="form-section">
            <h2>Check Eligible</h2>
            <a href="#" class="registration-link">Check now</a>
        </section>

        <section class="form-section">
            <h2>Edit Profile</h2>
            <a href="#" class="registration-link">Edit</a>
        </section>

        <br>
        <h2>Donate your blood with us to earn numerous benefits!</h2>
        <table class="reward">
            <tr>
                <th>Frequency (within a year)</th>
                <th>Rewards</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Free 1 outpatient treatment and 1 medical treatment</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Free 1 outpatient treatment and 2nd class wards for a period of 4 months</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Free 3 outpatient treatment and 2nd class medical treatment for a 6 month period</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Free 1 year outpatient treatment, free Influenza Vaccine and 2nd class medical treatment for a 8 month period</td>
            </tr>
        </table>
    </main>

    <footer>
        <img src="bottom.png" alt="Footer Image">
        <p>&copy; 2024 WeBleed - Blood Donation Website</p>
    </footer>
</body>