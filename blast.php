<?php
set_time_limit(240000);
include('conection.php');
$Id_Project 	= $_GET["id"];
$Hits_Align		= $_GET["Hits"];
$Program		= $_GET["Program"];
$evalue			= $_GET["evalue"];
$db 			= $_GET["DataBase"];
$Start			= $_GET["Start"];
$Total_Seq  	= $_GET["Qtde_Seq"];
$i 				= $_GET["i"];
$cpu			= $_GET["CPU"];
$verify 	= ("SELECT * FROM newprojects WHERE Id_Project = '$Id_Project'");
$qverify 	= mysqli_query($mysqli, $verify);
($line = $qverify->fetch_assoc());
$dir = ('Projects/'.$line["ProjectName"]);

$Projetos	  = ("SELECT * FROM projetos WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$qry = mysqli_query($mysqli, $Projetos);
($row = $qry->fetch_assoc());
?>
<style>
meter {
  width: 90%;
  height: 25px;
}
</style>
<script>
setTimeout(function() {
  window.location.reload(1);
}, 1800000); // 3 minutos
</script>

<div class="progress" style="height: 150px; width: 80%; margin: 0 auto;">
<div class="progress-bar bg-dark progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 2)."%"; ?>;" aria-valuenow="<?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 1); ?>" aria-valuemin="0" aria-valuemax="100"><mark><?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 2)."%"; ?></mark></div>
</div>
<div class="card" style="width: 80%; margin: 0 auto;">
<div class="bg-dark text-white" align="center" style="vertical-align: middle; font-size: 20px;"><?php echo $line["ProjectName"];?><br>Blasting Sequences <b><?php echo ($Start);?></b> of <b><?php echo ($Total_Seq);?></b><br>Remaining <b><?php echo ($Total_Seq-$Start);?></b></div>
</div>	

<?php
$input = "$dir"."/fasta/"."$Start".".fasta";

$cmd = "./apps/ncbi/".$Program." -db db/".$db."/".$db. " -query ".$input." -outfmt " . "14" . " -out " . $dir."/xml/".$Start.".xml" . " -num_threads ". $cpu ." -max_target_seqs ".$Hits_Align." -evalue ".$evalue;
echo $cmd;
exec($cmd);
$del = "rm ".$input;
exec($del);




$xml_Name	=   $dir."/xml/".$Start."_1.xml";
$sqli		=	("UPDATE projetos SET BlastStatus = 'Blasted', xml_File = '$xml_Name' WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$Next = $Start + 1;
$querry 	= mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>"); 
	if ($Next <= $Total_Seq){
	print
	"<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Blast&id=$Id_Project&Program=$Program&DataBase=$db&evalue=$evalue&Hits=$Hits_Align&Start=$Next&Qtde_Seq=$Total_Seq&i=$i&CPU=$cpu'>";
	} if ($Next >= $Total_Seq+1){
	print	
	"<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=index.php?p=xml_Verify&id=$Id_Project&Start=$i&Qtde_Seq=$Total_Seq&i=$i'>
	<h1 align='Center'>Analyzing the Results</h1>";
	
	}
?>
