<?php
ini_set('memory_limit','10240M');
ini_set('post_max_size', '10240M');
ini_set('upload_max_filesize', '10240M');

include('connection.php');
$Action     = $_GET["action"];
$Gene 	= $_GET["txtGene"];
$idGene = $_GET["id"];

$verify 	= ("SELECT * FROM newprojects WHERE Id_Project = '$idGene'");
$qverify 	= mysqli_query($mysqli, $verify);
($line = $qverify->fetch_assoc());
$dir = ('Projects/'.$line["ProjectName"]."/fasta/");

if($Action == "exportWEGO"){
$query 		= $_GET["query"];
$Projetos	  = ("SELECT * FROM projetos WHERE Project_Name = '".$idGene."' AND Description LIKE '%$Gene%' AND GO_Annotation = 'Annotation'");
$qry = mysqli_query($mysqli, $Projetos);
($row = $qry->fetch_assoc());
while ($row = $qry->fetch_assoc()) {
//echo (">".$row["SeqNames"]."\r\n".wordwrap($row["Seq"], 60, "\r\n", true));
$Seq[] = trim((mb_strimwidth($row["Project"], 0, 30, "")))."\t".(str_replace(";", "\t", $row["GO"]))."\r\n";
}

//Create File Fasta
$File_Name = $line["ProjectName"]."_WEGO.txt";
$texto_arquivo = implode('', $Seq);
if(file_exists("$dir"."$File_Name")) {
$fp = fopen("$dir"."$File_Name", "w");
fwrite($fp, "$texto_arquivo");
fclose($fp);
} else {
$fp = fopen("$dir"."$File_Name", "w");
fwrite($fp, "$texto_arquivo");
fclose($fp);
}
$filename = $dir.$File_Name;
if(ini_get('zlib.output_compression'))
ini_set('zlib.output_compression', 'Off');
$file_extension = strtolower(substr(strrchr($filename,"."),1));
if($filename=="") {
echo "nenhum arquivo foi especificado para download";
exit;
}elseif(!file_exists($filename)) {
echo "<h1 align='center'>Fasta File not Found!</h1>";
exit;
};

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Expires: 0');
// Envia o arquivo para o cliente
readfile($filename);
}
if($Action == "exportWEGOall"){
$query 		= $_GET["query"];
$Projetos	  = ("SELECT * FROM projetos WHERE Project_Name = '".$idGene."' AND GO_Annotation = 'Annotation'");
$qry = mysqli_query($mysqli, $Projetos);
($row = $qry->fetch_assoc());
while ($row = $qry->fetch_assoc()) {
//echo (">".$row["SeqNames"]."\r\n".wordwrap($row["Seq"], 60, "\r\n", true));
$Seq[] = str_replace(" ", "_", $row["Project"])."\t".(str_replace(";", "\t", $row["GO"]))."\r\n";
}

//Create File Fasta
$File_Name = $line["ProjectName"]."_WEGO_All.txt";
$texto_arquivo = implode('', $Seq);
if(file_exists("$dir"."$File_Name")) {
$fp = fopen("$dir"."$File_Name", "w");
fwrite($fp, "$texto_arquivo");
fclose($fp);
} else {
$fp = fopen("$dir"."$File_Name", "w");
fwrite($fp, "$texto_arquivo");
fclose($fp);
}
$filename = $dir.$File_Name;
if(ini_get('zlib.output_compression'))
ini_set('zlib.output_compression', 'Off');
$file_extension = strtolower(substr(strrchr($filename,"."),1));
if($filename=="") {
echo "nenhum arquivo foi especificado para download";
exit;
}elseif(!file_exists($filename)) {
echo "<h1 align='center'>Fasta File not Found!</h1>";
exit;
};

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header("Content-Type: application/force-download"); 
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Expires: 0');
// Envia o arquivo para o cliente
readfile($filename);
}

if($Action == "Results"){
$Projetos	  = ("SELECT SeqNames, Seq FROM projetos WHERE Project_Name = '".$idGene."' AND Blast = 'Hits'");
$qry = mysqli_query($mysqli, $Projetos);
($row = $qry->fetch_assoc());
while ($row = $qry->fetch_assoc()) {
//echo (">".$row["SeqNames"]."\r\n".wordwrap($row["Seq"], 60, "\r\n", true));
$Seq[] = (">".$row["SeqNames"]."\r\n".$row["Seq"]."\r\n");
}

//Create File Fasta
$File_Name = $line["ProjectName"]."_HITS.fasta";
$texto_arquivo = implode('', $Seq);
if(file_exists("$dir"."$File_Name")) {
$fp = fopen("$dir"."$File_Name", "w");
fwrite($fp, "$texto_arquivo");
fclose($fp);
} else {
$fp = fopen("$dir"."$File_Name", "w");
fwrite($fp, "$texto_arquivo");
fclose($fp);
}
$filename = $dir.$File_Name;
if(ini_get('zlib.output_compression'))
ini_set('zlib.output_compression', 'Off');
$file_extension = strtolower(substr(strrchr($filename,"."),1));
if($filename=="") {
echo "nenhum arquivo foi especificado para download";
exit;
}elseif(!file_exists($filename)) {
echo "<h1 align='center'>Fasta File not Found!</h1>";
exit;
};

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Expires: 0');
// Envia o arquivo para o cliente
readfile($filename);	
}
?>
