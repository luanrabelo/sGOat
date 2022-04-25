<?php
include("Connection.php");
set_time_limit(0);
$upload = 'err';
if(!empty($_FILES['file'])){
$idRepository 	= $_POST["idRepository"];
$idUser 		= $_POST["idUser"];
$Repository 	= $_POST["RepositoryCod"];

$TargetDir = "Uploads/";
$TypesFile = array('fasta', 'fas', 'fa'); 
     
$FileName = basename($_FILES['file']['name']); 
$FilePath = $TargetDir.$FileName; 
$FileType = pathinfo($FilePath, PATHINFO_EXTENSION); 
if(in_array($FileType, $TypesFile)){ 
if(move_uploaded_file($_FILES['file']['tmp_name'], $FilePath)){
exec("python3 Scripts/ReadFastaFile.py $FilePath $Repository $idRepository $idUser $host $user $pass $bd", $Return);
$upload = 'ok'; 
}}} 
echo $upload; 
?>