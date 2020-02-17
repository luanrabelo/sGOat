<script>
setTimeout(function() {
  window.location.reload(1);
}, 30000);
</script>

<?php
function xmlEscape($string) {
	return str_replace(array('&', '<', '>', '\'', '"'), array('&amp;', '&lt;', '&gt;', '&apos;', '&quot;'), $string);
}

include('conection.php');

$Id_Project     = $_GET["id"];
$Start			= $_GET["Start"];
$Total_Seq  	= $_GET["Qtde_Seq"];
$i 				= $_GET["i"];

$Projetos	  	= ("SELECT * FROM projetos WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$qry 			= mysqli_query($mysqli, $Projetos);
($row 			= $qry->fetch_assoc());

if ($row["Hits"] == "-") {
$sqli	=	("UPDATE projetos SET GO = '-', GO_IDs = '-', GO_Names = '-', Enzymes_Code = '-', Enzymes_Name = '-', InterPro_IDs = '-', InterPro_GO_IDs = '-', InterPro_GO_Names = '-' WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$Next = $Start + 1;
$querry = mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>"); 
if ($Next <= $Total_Seq){print "<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=UniProt&id="."$Id_Project"."&Start=".$Next."&Qtde_Seq="."$Total_Seq&i=$i"."'>";
}} 

else {
$Next 		= $Start + 1;	
$link 		= "https://www.uniprot.org/uniprot/".$row["Accession"].".xml";
$xml  		= simplexml_load_file($link) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=UniProt&id="."$Id_Project"."&Start=".$Next."&Qtde_Seq="."$Total_Seq&i=$i"."'>");
$nodes		= $xml->xpath('//*[@type="GO"]');

if(count($nodes) < 1)  {
$sqli     	= ("UPDATE projetos SET GO_Annotation = 'No Annotation' WHERE Project_Name = '$Id_Project' AND Project = '$Start'");
	$querry 	= mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>");
	if ($Next <= $Total_Seq){print "<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=UniProt&id="."$Id_Project"."&Start=".$Next."&Qtde_Seq="."$Total_Seq&i=$i"."'>";}
	if ($Next >= $Total_Seq+1){print "<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=ShowSequence&id="."$Id_Project"."'><h1 align='Center'>Termos GO obtidos com Sucesso!<br>Redirecionando para página de sequências</h1>";}	
}	
	
if(count($nodes) > 0) {
foreach ($nodes as $GOreference){
$NumberGO 	=  $GOreference['id'];
$sqli     	= ("UPDATE projetos SET GO = CONCAT(GO, '$NumberGO','; '), GO_Annotation = 'Annotation' WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$querry 	= mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>");}
}

//Get organism name to make a species distribuition 	
$organism		= $xml->xpath('//*[@type="scientific"]');	
if(count($organism) > 0) {
foreach ($organism as $ScientificName){
$Organism_name = xmlEscape($ScientificName);	
$sqli     	= ("UPDATE projetos SET organism = '$Organism_name' WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$querry 	= mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>");}
}	
	
$term		= $xml->xpath('//*[@type="term"]');
if(count($term) > 0) {
foreach ($term as $GOterm){
$TermName 	=  xmlEscape($GOterm['value']);
$sqli     	= ("UPDATE projetos SET GO_Names = CONCAT(GO_Names, '$TermName',';<br>') WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$querry 	= mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>");}
}	
	if ($Next <= $Total_Seq){print "<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=UniProt&id="."$Id_Project"."&Start=".$Next."&Qtde_Seq="."$Total_Seq&i=$i"."'>";}
	if ($Next >= $Total_Seq+1){print "<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=ShowSequence&id="."$Id_Project"."'><h1 align='Center'>Termos GO obtidos com Sucesso!<br>Redirecionando para página de sequências</h1>";}	
	
}

?>
<p align="center">
<div class="progress" style="height: 150px; width: 80%; margin: 0 auto;">
<div class="progress-bar bg-dark progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 2)."%"; ?>;" aria-valuenow="<?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 1); ?>" aria-valuemin="0" aria-valuemax="100"><mark><?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 2)."%"; ?></mark></div>
</div>
<div class="card" style="width: 80%; margin: 0 auto;">
<div class="bg-dark text-white" align="center" style="vertical-align: middle; font-size: 20px;"><?php echo $line["ProjectName"];?><br>Requesting GO terms <b><?php echo ($Start);?></b> of <b><?php echo ($Total_Seq);?></b><br>Remaining <b><?php echo ($Total_Seq-$Start);?></b></div>
</div>	
</p>
</body>
</html>
