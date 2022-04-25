<?php
$bd			= "sgoat"; // Database name. i.e. sgoat-database
$user 		= "root"; // UserName MySQL database
$pass	 	= "root"; // Password MySQL database
$host 		= "localhost"; // Host MySQL database
$port 		= "3306"; // Port MySQL database

// Check connection
$Connection = new mysqli($host, $user, $pass);
if ($Connection->connect_error) {
    die ("Connection failed: " . $Connection->connect_error);
} else {
	$ConQuery = mysqli_connect($host, $user, $pass);
	$sql = "CREATE DATABASE IF NOT EXISTS $bd";
	mysqli_query($ConQuery, $sql);
}

$mysqli = mysqli_connect($host, $user, $pass, $bd);
mysqli_set_charset($mysqli, "utf8");
?>
