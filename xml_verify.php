<?php
set_time_limit(240000);
include('connection.php');
$Id_Project 	= $_GET["id"];
$Start			= $_GET["Start"];
$Total_Seq  	= $_GET["Qtde_Seq"];
$i 				= $_GET["i"];
$verify 	= ("SELECT * FROM newprojects WHERE Id_Project = '".$Id_Project."'");
$qverify 	= mysqli_query($mysqli, $verify);
($line = $qverify->fetch_assoc());
$dir = ('Projects/'.$line["ProjectName"]);
$Projetos	  = ("SELECT * FROM projetos WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$qry = mysqli_query($mysqli, $Projetos);
($row = $qry->fetch_assoc());

function xmlEscape($string) {
	return str_replace(array('&', '<', '>', '\'', '"'), array('&amp;', '&lt;', '&gt;', '&apos;', '&quot;'), $string);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<script>
setTimeout(function() {
  window.location.reload(1);
}, 30000);
</script>
<body>
<?php
$xml = simplexml_load_file($row['xml_File']) or die("Error: Cannot able to create object");
?>
<div class="progress" style="height: 150px; width: 80%; margin: 0 auto;">
<div class="progress-bar bg-dark progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 2)."%"; ?>;" aria-valuenow="<?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 1); ?>" aria-valuemin="0" aria-valuemax="100"><mark><?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 2)."%"; ?></mark></div>
</div>
<div class="card" style="width: 80%; margin: 0 auto;">
<div class="bg-dark text-white" align="center" style="vertical-align: middle; font-size: 20px;"><?php echo $line["ProjectName"];?><br>Analyzing Results <b><?php echo ($Start);?></b> of <b><?php echo ($Total_Seq);?></b><br>Remaining <b><?php echo ($Total_Seq-$Start);?></b></div>
</div>	
<?php
if (strpos($xml->report->Report->results->Results->search->Search->message, "No hits found") !== false){
$sqli	=	("UPDATE projetos SET Blast = 'No Hits', Description='-', Hits='-', eValue='-', simmean='-', GO='-', GO_IDs='-', GO_Names='-', Enzymes_Code='-', Enzymes_Name='-', InterPro_IDs='-', InterPro_GO_IDs='-', InterPro_GO_Names='-', Accession='X' WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$Next = $Start + 1;
$querry = mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>"); 
if ($Next <= $Total_Seq){
print
"<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=xml_Verify&id="."$Id_Project"."&Start=".$Next."&Qtde_Seq="."$Total_Seq&i=$i"."'>";
}
}else {
$Number_Hits = $xml->report->Report->results->Results->search->Search->hits->Hit->count();
$BestR 		 = xmlEscape($xml->report->Report->results->Results->search->Search->hits->Hit->description->HitDescr->title);
$eValue		 = $xml->report->Report->results->Results->search->Search->hits->Hit->hsps->Hsp->evalue;
$Accession	 = $xml->report->Report->results->Results->search->Search->hits->Hit->description->HitDescr->accession;
$Sim 		 = number_format((($xml->report->Report->results->Results->search->Search->hits->Hit->hsps->Hsp->positive)*100)/($xml->report->Report->results->Results->search->Search->hits->Hit->hsps->Hsp->{'align-len'}), 2);
	
$sqli	=	("UPDATE projetos SET Blast = 'Hits', Hits='$Number_Hits', Description='$BestR', eValue='$eValue', Accession='$Accession', simmean='$Sim', GO = '', GO_IDs='', GO_Names='', Enzymes_Code='', Enzymes_Name='', InterPro_IDs='', InterPro_GO_IDs='', InterPro_GO_Names='' WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$Next = $Start +1;
$querry = mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>"); 	
if ($Next <= $Total_Seq){
print
"<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=xml_Verify&id="."$Id_Project"."&Start=".$Next."&Qtde_Seq="."$Total_Seq&i=$i"."'>";
} if ($Next >= $Total_Seq+1){
print	
"<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=UniProt&id=$Id_Project&Start=$i&Qtde_Seq=$Total_Seq&i=$i'><h1 align='Center'>Inicializando a Conexão com o UniProt para analizar os resultados!</h1>";
}

}
?>
</body>
</html>
