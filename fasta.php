<?php
include('conection.php');
$Id_Project 	= $_GET["id"];
$Program		= $_GET["Program"];
$db 			= $_GET["DataBase"];
$evalue			= $_GET["evalue"];
$Hits_Align		= $_GET["Hits"];
$Start			= $_GET["Start"];
$Total_Seq  	= $_GET["Qtde_Seq"];
$i  			= $_GET["i"];
$cpu  			= $_GET["CPU"];

$verify 	= ("SELECT * FROM newprojects WHERE Id_Project = '$Id_Project'");
$qverify 	= mysqli_query($mysqli, $verify);
($line = $qverify->fetch_assoc());
$dir = ('Projects/'.$line["ProjectName"]."/fasta/");


$Projetos	= ("SELECT * FROM projetos WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$qry = mysqli_query($mysqli, $Projetos);
($row = $qry->fetch_assoc());
?>
<script>
setTimeout(function() {
  window.location.reload(1);
}, 180000); // 3 minutos
</script>
<div class="progress" style="height: 150px; width: 80%; margin: 0 auto;">
<div class="progress-bar bg-dark progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 2)."%"; ?>;" aria-valuenow="<?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 1); ?>" aria-valuemin="0" aria-valuemax="100"><mark><?php echo number_format(((($Start-$i)*100)/($Total_Seq-$i)), 2)."%"; ?></mark></div>
</div>
<div class="card" style="width: 80%; margin: 0 auto;">
<div class="bg-dark text-white" align="center" style="vertical-align: middle; font-size: 20px;"><?php echo $line["ProjectName"];?><br>Creating Fasta File<br>Remaining <b><?php echo ($Total_Seq-$Start);?></b> files</div>
</div>	

<?php
// Nome do Arquivo que vai ser criado
$File_Name = $row["Project"].".fasta";

// Dados a serem escrito no arquivo
$texto_arquivo = ">".$row["SeqNames"]."\r\n".wordwrap($row["Seq"], 60, "\r\n", true);

// se arquivo já existe
if(file_exists("$dir"."$File_Name")) {
// abre o arquivo para reescrever
$fp = fopen("$dir"."$File_Name", "w");
// escreve no arquivo
fwrite($fp, "$texto_arquivo");
// fecha o arquivo
fclose($fp);
// ser arquivo não existir
} else {
// cria um novo arquivo e abrindo para escrita
$fp = fopen("$dir"."$File_Name", "w");
// escreve o seu texto no arquivo
fwrite($fp, "$texto_arquivo");
// fecha o arquivo
fclose($fp); // fecha arquivo
}
//
$sqli	=	("UPDATE projetos SET Fasta_File = '$File_Name' WHERE Project_Name = '".$Id_Project."' AND Project = '".$Start."'");
$Next = $Start + 1;
$querry = mysqli_query($mysqli, $sqli) or die ("<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Home'>"); 
	if ($Next <= $Total_Seq){
	print
	"<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=index.php?p=Fasta&id=$Id_Project&Program=$Program&DataBase=$db&evalue=$evalue&Hits=$Hits_Align&Start=$Next&Qtde_Seq=$Total_Seq&i=$i&CPU=$cpu'>";
	} if ($Next >= $Total_Seq+1){
	print	
	"<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=index.php?p=Blast&id=$Id_Project&Program=$Program&DataBase=$db&evalue=$evalue&Hits=$Hits_Align&Start=$i&Qtde_Seq=$Total_Seq&i=$i&CPU=$cpu'>
	<h1 align='Center'>All fasta file created</h1>";
	
	}
?>

