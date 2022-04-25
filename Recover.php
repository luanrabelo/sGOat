<?php
include("Connection.php");
$FirstName 		= $_POST['FirstName'];
$LastName 		= $_POST['LastName'];
$Birthday 		= $_POST['Birthday'];
$Email	 		= $_POST['Email'];
$Institution	= $_POST['Institution'];

$search 	= mysqli_query($mysqli, "SELECT * FROM users WHERE FirstName = '$FirstName' and LastName = '$LastName' and Institution = '$Institution' and Birthday = '$Birthday' and Email = '$Email'") or die (mysql_error());	
sleep(3);
if (mysqli_num_rows($search) == 0) {
echo 0;
}else{
while ($row = $search->fetch_assoc()){	
$KeyUser = $row["KeyUser"];
}
echo json_encode(array('KeyUser' => "$KeyUser"));	
}
?>	