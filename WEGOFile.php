<?php
include("Connection.php");
$Table 		= $_GET["table"];
$KeyUser 	= $_GET["KeyUser"];

$Projetos	  = ("SELECT * FROM $Table WHERE GONames != '' AND GONames != '-'");
$qry = mysqli_query($mysqli, $Projetos);
($row = $qry->fetch_assoc());
while ($row = $qry->fetch_assoc()) {
//echo (">".$row["SeqNames"]."\r\n".wordwrap($row["Seq"], 60, "\r\n", true));
$Seq[] = trim((mb_strimwidth($row["SeqName"], 0, 30, "")))."\t".(str_replace(";", "\t", $row["GONames"]))."\r\n";
}
//Create File Fasta
$File_Name = $KeyUser.$Table."_sGOat_WEGO.txt";
$texto_arquivo = implode('', $Seq);
if(file_exists("$File_Name")) {
$fp = fopen("$File_Name", "w");
fwrite($fp, "$texto_arquivo");
fclose($fp);
} else {
$fp = fopen("$File_Name", "w");
fwrite($fp, "$texto_arquivo");
fclose($fp);
}
$filename = $File_Name;
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
?>