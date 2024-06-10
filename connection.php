<?php

$host_name = "localhost";

$user_sql = "root";

$pass_sql = "";

$db_name="webleeddb";

$condb=mysqli_connect($host_name,$user_sql,$pass_sql,$db_name);

if (!$condb)
{
	die("Error: Could not connect to the database");
}
else
{
	# echo "Database connected";
}
?>
