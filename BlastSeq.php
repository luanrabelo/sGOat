<?php
set_time_limit(0);
include("Connection.php");
if (isset($_POST["KeyUser"])){
$Repository 	= $_POST['Repository'];
$idUser			= $_POST['idUser'];
$idRepository 	= $_POST['idRepository'];
$KeyUser 		= $_POST['KeyUser'];
	
$Blast			= $_POST['Blast'];
$Database 		= $_POST['BlastDatabase'];
$eValue 		= $_POST['eValue'];
$Hits 			= $_POST['BlastHits'];
$CPU 			= $_POST['BlastCPU'];

$cmd = "python3 sGOat.py $host $user $pass $bd $idUser $idRepository $KeyUser $Repository $Blast $Database $eValue $Hits $CPU";
echo($cmd);
exec($cmd);
}
?>