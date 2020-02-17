<?php
include('conection.php');
$Id_Project = $_GET["id"];
$Action     = $_GET["action"];

$verify 	= ("SELECT * FROM newprojects WHERE Id_Project = '$Id_Project'");
$qverify 	= mysqli_query($mysqli, $verify);
($line = $qverify->fetch_assoc());
$dir = ('Projects/'.$line["ProjectName"]."/fasta/");

if($Action == "search"){
$query 		= $_GET["query"];
$Projetos	  = ("SELECT SeqNames, Seq FROM projetos WHERE Project_Name = '".$Id_Project."' AND Description LIKE '%$query%'");
$qry = mysqli_query($mysqli, $Projetos);
($row = $qry->fetch_assoc());
while ($row = $qry->fetch_assoc()) {
//echo (">".$row["SeqNames"]."\r\n".wordwrap($row["Seq"], 60, "\r\n", true));
$Seq[] = (">".$row["SeqNames"]."\r\n".$row["Seq"]."\r\n");
}

//Create File Fasta
$File_Name = $line["ProjectName"]."_RESULTS.fasta";
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
}else{

$Projetos	  = ("SELECT SeqNames, Seq FROM projetos WHERE Project_Name = '".$Id_Project."' AND Blast = 'No Hits'");
$qry = mysqli_query($mysqli, $Projetos);
($row = $qry->fetch_assoc());
while ($row = $qry->fetch_assoc()) {
//echo (">".$row["SeqNames"]."\r\n".wordwrap($row["Seq"], 60, "\r\n", true));
$Seq[] = (">".$row["SeqNames"]."\r\n".$row["Seq"]."\r\n");
}

//Create File Fasta
$File_Name = $line["ProjectName"]."_NO_HITS.fasta";
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
