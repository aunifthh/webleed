<?php
session_start();
include('connection.php');

// Fetch donor details from the database
$query = "SELECT donor.donID, donor.donName, donor.donBloodType, donor.donBloodQty, donor.donWeight, donor.donFrequency, donor.eligibleStatus, bloodcenter.bcName 
          FROM donor 
          JOIN staff ON donor.staffID = staff.staffID 
          JOIN bloodcenter ON staff.bcID = bloodcenter.bcID";
$result = mysqli_query($condb, $query);

if (!$result) {
    die('Error fetching donor data: ' . mysqli_error($condb));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Details</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="logo.jpg">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f8f8f8;
            border-bottom: 1px solid #e7e7e7;
        }

        .navbar .logo_item {
            display: flex;
            align-items: center;
        }

        .navbar .logo_item img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar .navbar_content ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .navbar .navbar_content ul li {
            margin-left: 20px;
        }

        .navbar .navbar_content ul li a {
            text-decoration: none;
            color: #333;
        }

        .donor-details-section {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .donor-details-section h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .donor-details-section .button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            color: #fff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
        }

        .donor-details-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .donor-details-section table th, .donor-details-section table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .donor-details-section table th {
            background-color: #f2f2f2;
        }

        .donor-details-section table tr:hover {
            background-color: #f1f1f1;
        }

        .donor-details-section .button {
            color: white;
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .donor-details-section .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo_item">
            <img src="logo.jpg" alt="Company Logo">
            <span>WeBleed</span>
        </div>
        <div class="navbar_content">
            <ul>
                <li><a href="staff_details.php">Staff Details</a></li>
                <li><a href="donor_details.php">Donor Details</a></li>
                <li><a href="staff_profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="donor-details-section">
        <h2>Donor List</h2>
        <a href="add_donor.php" class="button">Add New Donor</a>
        <table>
            <thead>
                <tr>
                    <th>Donor ID</th>
                    <th>Name</th>
                    <th>Blood Type</th>
                    <th>Blood Quantity</th>
                    <th>Weight</th>
                    <th>Donation Frequency</th>
                    <th>Eligibility Status</th>
                    <th>Blood Center</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['donID']; ?></td>
                    <td><?php echo $row['donName']; ?></td>
                    <td><?php echo $row['donBloodType']; ?></td>
                    <td><?php echo $row['donBloodQty']; ?></td>
                    <td><?php echo $row['donWeight']; ?></td>
                    <td><?php echo $row['donFrequency']; ?></td>
                    <td><?php echo $row['eligibleStatus']; ?></td>
                    <td><?php echo $row['bcName']; ?></td>
                    <td>
                        <a href="edit_donor.php?donID=<?php echo $row['donID']; ?>" class="button">Edit</a>
                        <a href="delete_donor.php?id=<?php echo $row['donID']; ?>" class="button" onclick="return confirm('Are you sure you want to delete this donor?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
mysqli_close($condb);
?>
