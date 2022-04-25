<?php
set_time_limit(0);
include("Connection.php");
function xmlEscape($string) {
	return str_replace(array('&', '<', '>', '\'', '"'), array('&amp;', '&lt;', '&gt;', '&apos;', '&quot;'), $string);
}

if(isset($_POST['KeyUser'])){
$data = 0;
$count = 0;
$Repository = $_POST['Repository'];
$idUser		= $_POST['idUser'];
$idRepository = $_POST['idRepository'];
$KeyUser = $_POST['KeyUser'];
	
$sql	  	= ("SELECT * FROM $Repository WHERE Accession != '-' OR Accession != ''");
$qry 			= mysqli_query($mysqli, $sql);
while ($row = $qry->fetch_assoc()) {
if ($row["Hits"] == "0") {
$sqli	=	("UPDATE $Repository SET GONames = '-', GOFunctions = '-' WHERE idUser = '$idUser' AND idRepository = '$idRepository' AND id = ".$row["id"]."");
$querry = mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>"); 
} else {
$count = $count + 1;
$link 		= "Users/$KeyUser/$Repository/uniprot/".$row["Accession"].".xml";
$xml  		= simplexml_load_file($link);
$nodes		= $xml->xpath('//*[@type="GO"]');
if(count($nodes) < 1) {
$sqli     	= ("UPDATE $Repository SET Status = 'NoAnnot' WHERE idUser = '$idUser' AND idRepository = '$idRepository' AND id = ".$row["id"]."");
$querry 	= mysqli_query($mysqli, $sqli);
}	
if(count($nodes) > 0) {
foreach ($nodes as $GOreference){
$NumberGO 	=  $GOreference['id'];
$sqli     	= ("UPDATE $Repository SET GONames = CONCAT(GONames, '$NumberGO','; '), Status = 'Annotation' WHERE idUser = '$idUser' AND idRepository = '$idRepository' AND id = ".$row["id"]."");
$querry 	= mysqli_query($mysqli, $sqli);
}
}
$organism		= $xml->xpath('//*[@type="scientific"]');	
if(count($organism) > 0) {
foreach ($organism as $ScientificName){
$Organism_name = xmlEscape($ScientificName);	
$sqli     	= ("UPDATE $Repository SET Organism = '$Organism_name' WHERE idUser = '$idUser' AND idRepository = '$idRepository' AND id = ".$row["id"]."");
$querry 	= mysqli_query($mysqli, $sqli);
}
}	
$term		= $xml->xpath('//*[@type="term"]');
if(count($term) > 0) {
foreach ($term as $GOterm){
$TermName 	=  xmlEscape($GOterm['value']);
$sqli     	= ("UPDATE $Repository SET GOFunctions = CONCAT(GOFunctions, '$TermName',';<br>') WHERE idUser = '$idUser' AND idRepository = '$idRepository' AND id = ".$row["id"]."");
$querry 	= mysqli_query($mysqli, $sqli);}
}		
}

$sqli     	= ("UPDATE repodata SET Status = 'Annotated', Annotation = '$count' WHERE idUser = '$idUser' AND idRepository = '$idRepository'");
$querry 	= mysqli_query($mysqli, $sqli);
	
}
echo($data);
}
?>
