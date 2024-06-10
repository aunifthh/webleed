<?PHP
session_start();

# check whether the following information exists or not
if (empty($_POST['id']) or empty($_POST['password']) or empty($_POST['type']))
{
	# If it does not exist
    die("<script>
            alert('The username and password you entered did not match our records. Please double-check and try again.');
            window.location.href='index.php';
        </script>");
}

# STAFF
if($_POST['type']=='staff')
{
	$table  = "staff";
	$field1  = "staffid";
    $field2  = "staffpassword";
	$field3  = "staffname";
	$field4  = "staffphoneno";
	$location  = "staff/index.php";
}

# DONOR
else if($_POST['type']=='donor')
{
	$table  = "donor";
	$field1  = "donid";
    $field2  = "donpassword";
	$field3  = "donname";
	$location  = "donor/index.php";
}

# HEALTHCARE PROVIDER
else if($_POST['type']=='healthcareprovider')
{
    $table = "healthcareprovider";
    $field1 = "hpid";
    $field2 = "hppassword";
    $location = "hp/index.php";
}

include('connection.php');

# Retrieve and sanitize POST data
$id = mysqli_real_escape_string($condb,$_POST['id']);
$password = mysqli_real_escape_string($condb,$_POST['password']);

# SQL command to compare data
$sql_login = "SELECT * FROM $table WHERE $field1 = '$id' AND $field2 = '$password' LIMIT 1";

# Execute the login command
$result_login = mysqli_query($condb, $sql_login);

# If there is 1 matching record
if (mysqli_num_rows($result_login) == 1) {
    # Login successful, assign session variables
    $data = mysqli_fetch_array($result_login);
    $_SESSION[$field3] = $data[$field3];
    $_SESSION[$field1] = $data[$field1];
    echo "<script>window.location.href='$location';</script>";
} else {
    # Login failed
    echo "<script>
            alert('Incorrect ID and Password');
            window.history.back();
        </script>";
}

# Close the connection between the system and the database
mysqli_close($condb);
?>
