<?php
$bd			= "luan";
$user 		= "root";
$pass	 	= "biodattadl380";
$host 		= "localhost";

$mysqli = @mysqli_connect($host, $user, $pass, $bd);
if (mysqli_connect_errno()) {
$servername = $host;
$username   = $user;
$password   = $pass;

// Creating a connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Creating a database named newDB
$sql = "CREATE DATABASE IF NOT EXISTS $bd";
$filemysql = "blast.sql";	
if ($conn->query($sql) === TRUE) {
$command='mysql -h' .$servername .' -u' .$username .' -p' .$password .' ' .$bd .' < ' .$filemysql;
exec($command,$output=array(),$worked);
switch($worked){
    case 0:
        echo 'Import file <b>' .$mysqlImportFilename .'</b> successfully imported to database <b>' .$filemysql .'</b>';
        break;
    case 1:
        echo 'There was an error during import. Please make sure the import file is saved in the same folder as this script and check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$bd .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$servername .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$username .'</b></td></tr><tr><td>MySQL Import Filename:</td><td><b>' .$filemysql .'</b></td></tr></table>';
        break;
}
    echo "Database created successfully with the name ".$bd;
	echo "<br>Refresh the page";
} else {
    echo "Error creating database: " . $conn->error;
}	
exit();
$conn->close();
}
?>