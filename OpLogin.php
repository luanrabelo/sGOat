<?php
//session_save_path('/home/luanrabelo2/tmp');
include("Connection.php");

$Login			=	$_POST['Login'];
$Password 		= 	hash('sha512', $_POST['Pass']);

$sql			= ("SELECT * FROM `users` WHERE Email = '".$Login."' and Password = '".$Password."'"); 
$resultados 	= mysqli_query($mysqli, $sql) or die (mysql_error());	
$res			= mysqli_fetch_array($resultados); 

if (mysqli_num_rows($resultados) == 0) {
sleep(2);
echo 0;

} else {	
session_start();	
$_SESSION['idUser']			= $res['idUser']; 		
$_SESSION['FirstName']		= $res['FirstName'];
$_SESSION['LastName']		= $res['LastName'];	
$_SESSION['Email']			= $res['Email'];	
$_SESSION['Birthday']		= $res['Birthday'];	
$_SESSION['KeyUser']		= $res['KeyUser'];
$_SESSION['Assistance']		= $_POST['Assistance'];

session_write_close();
	
sleep(2);	
echo 1;
exit;	
} 			
?>