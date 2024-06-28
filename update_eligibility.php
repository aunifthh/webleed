<?php
session_start();

if (!isset($_SESSION['donID'])) {
    echo "You must be logged in as a donor to update eligibility status.";
    exit();
}

include('connection.php');

$donID = $_SESSION['donID'];
$donWeight = $_POST['donWeight'];
$isEligible = $_POST['isEligible'];

// Additional field for pregnancy
$pregnant = isset($_POST['pregnant']) ? $_POST['pregnant'] : 'no';

// Check if pregnant
if ($pregnant === 'yes') {
    $isEligible = 'N'; // If pregnant, not eligible
}

// Update the eligibility status in the database
$query = "UPDATE donor SET  donWeight = ?, eligibleStatus = ? WHERE donID = ?";
$stmt = $condb->prepare($query);
$stmt->bind_param("isi", $donWeight, $isEligible, $donID);

if ($stmt->execute()) {
    echo "Eligibility status updated successfully.";
} else {
    echo "Error updating eligibility status: " . $stmt->error;
}

$stmt->close();
$condb->close();
?>
