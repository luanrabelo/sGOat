<?php
//Incluí o arquivo de conexão;
include('conection.php');

//Pega a ação da página;
$action 	= $_GET["action"];

//Se a ação for igual a Cadastrar
if ($action == "CdsNewProject") {
$ProjectName 	= $_POST["ProjectName"];
$Blast			= $_POST["Blast"];
$InterPro		= $_POST["InterPro"];
$UniProt		= $_POST["UniProt"];
$Description	= $_POST["Description"];
	
$verify 	= ("SELECT * FROM newprojects WHERE ProjectName = '$ProjectName'");
$qverify 	= mysqli_query($mysqli, $verify);
$linha 		= mysqli_num_rows($qverify);
	
if($linha == 0){
$sqli   = ("INSERT INTO `newprojects`(`ProjectName`, `Blast`, `InterPro`, `UniProt`, `Description`) VALUES ('$ProjectName', '$Blast', '$InterPro', '$UniProt', '$Description')");
$querry = mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>
	<script type \"text/JavaScript\">
	alert(\"Erro to create $ProjectName, try again.\");
	</script>");
	print "<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>
	<script type \"text/JavaScript\">
	alert(\"Project $ProjectName created!\");
	</script>";
	mkdir(__DIR__.'/Projects/', 0777, true);	
	mkdir(__DIR__.'/Projects/'.$ProjectName.'/fasta', 0777, true);
	mkdir(__DIR__.'/Projects/'.$ProjectName.'/xml', 0777, true);
	mkdir(__DIR__.'/Projects/'.$ProjectName.'/interpro', 0777, true);
	mkdir(__DIR__.'/Projects/'.$ProjectName.'/ncbi_seq', 0777, true);}
	else{
	print "<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=NewProject'>
	<script type \"text/JavaScript\">
	alert(\"Project ($ProjectName) exist!\");
	</script>";}}

if ($action == "Delete") {
$Id_Delete      = $_GET["Id_Project"];	
$verify 	= ("SELECT * FROM newprojects WHERE Id_Project = '$Id_Delete'");
$qverify 	= mysqli_query($mysqli, $verify);
($line = $qverify->fetch_assoc());
$dir = ('Projects/'.$line["ProjectName"]);	
$remove = "rm -r ".$dir;
exec($remove);	
	
$Projetos	  	= ("DELETE FROM projetos WHERE Project_Name = $Id_Delete");
$qry 			= mysqli_query($mysqli, $Projetos);

	
$sqli	=	("DELETE FROM newprojects WHERE Id_Project = $Id_Delete");
$querry = mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>
	<script type \"text/JavaScript\">
	alert(\"Error\");
	</script>");
	print "<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>
	<script type \"text/JavaScript\">
	alert(\"Project ". $line["ProjectName"] ." Deleted!\");
	</script>";}

if ($action == "update") {
$idEdit			= $_GET["id"];	
$Blast			= $_POST["Blast"];
$InterPro		= $_POST["InterPro"];
$UniProt		= $_POST["UniProt"];
$Description	= $_POST["Description"];	
	
	
	
$sqli   = ("UPDATE `newprojects` SET `Blast`='$Blast',`InterPro`='$InterPro',`UniProt`='$UniProt',`Description`='$Description' WHERE `Id_Project`= '$idEdit'");
$querry = mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=NewProject&action=update&id=$idEdit'>
	<script type \"text/JavaScript\">
	alert(\"Error $ProjectName.\");
	</script>");
	print "<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>
	<script type \"text/JavaScript\">
	alert(\"Project $ProjectName updated!\");
	</script>";	
}
?>
