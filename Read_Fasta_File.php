<?php
$id = $_GET["id"];
$action = $_GET["action"];
include('conection.php');
ini_set('memory_limit', '1024M');
ini_set('upload_max_filesize', '500M');
ini_set('post_max_size', '500M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);

function xmlEscape($string) {
	return str_replace(array('&', '<', '>', '\'', '"'), array('&amp;', '&lt;', '&gt;', '&apos;', '&quot;'), $string);
}

function read_fas_file($x) { 
 if (!file_exists($x)) {
  print "<script language=JavaScript>alert(\"File not exist!!\");</script>";
  exit();
 } else {
  $fh = fopen($x, 'r');
  if (filesize($x) == 0) {
   print "<script language=JavaScript>alert(\"File is empty!!\");</script>";
   fclose($fh);
   exit();
  } else {
   $f = fread($fh, filesize($x));
   fclose($fh);
   return $f;
  }
 }
}
// Check FASTA File Format
// Verifica se é um arquivo FASTA
function fas_check($x) { 
 $gt = substr($x, 0, 1);
 if ($gt != ">") {
  print "<script language=JavaScript>alert(\"Not a Fasta file!!\");</script>";
  exit();
 } else {
  return $x;
 }
}

// Get Sequence and Sequence Name
// Pegas as Sequencias e o nome das mesmas
function get_seq($x) { 
 $fl = explode(PHP_EOL, $x);
 $sh = trim(array_shift($fl));
 if($sh == null) {
  $sh = "UNKNOWN SEQUENCE";
 }
 $fl = array_filter($fl);
 $seq = "";
 foreach($fl as $str) {
  $seq .= trim($str);
 }
 $seq = strtoupper($seq);
 $seq = preg_replace("/^ABCDEFGHIJKLMNOPQRSTUVXWYZ]/i", "", $seq);
 if ((count($fl) < 1) || (strlen($seq) == 0)) {
	 print "<script language=JavaScript>alert(\"Sequence is empty!!\");</script>";
  exit();
 } else {
  return array($sh, $seq);
 }
}
	
// Read Multiple FASTA Sequences
// Ler o Arquivo Fasta de Multiplas Sequências
function fas_get($x) { 
 $gtr = substr($x, 1);
 $sqs = explode(">", $gtr);
 if (count($sqs) > 1) {
  foreach ($sqs as $sq) {
   $spair = get_seq($sq);
   $spairs[$spair[0]] = $spair[1];
  }
  return $spairs;
 } else {
  $spair = get_seq($gtr);
  return array($spair[0] => $spair[1]);
 }
}

if ($action == "ImportFastaFile") {	
	
$Project 	= $_POST["id"];
$uploaddir = '/var/www/html/openGO/uploads';
$uploadfile = $uploaddir . $_FILES['FastaFile']['name'];
$upfile    = $uploaddir.basename($_FILES['FastaFile']['name']);
	
if (move_uploaded_file($_FILES['FastaFile']['tmp_name'], $uploaddir)) {
$file = $upfile;
//$file = "/home/luan/Downloads/MUSCULO_18_CAMARAO_S14_L005gc1_MicroFile.fasta";	
$content = read_fas_file($file);
$fasta = fas_check($content);
$seq = xmlEscape(fas_get($fasta));
foreach($seq as $x => $y) {
//Save Sequences in BD
$sqli   = ("INSERT INTO `projetos`(`Project_Name`, `SeqNames`, `Seq`) VALUES ('$Project', '$x', '$y')");
$querry = mysqli_query($mysqli, $sqli) or die ("Fudeu");
}
} else {
// Não foi possível fazer o upload, provavelmente a pasta está incorreta
echo "Upload error";
}
 	
}	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>
<body>
	
	  
		<p align="center"></p><?php if ($action == "ImportFastaFile") {echo('<p align="center">Parabéns, Arquivo<b>'.$file.'</b> importado com sucesso!<br>Um total de <b>'.substr_count($fasta, '>').'</b> sequências foram importadas!<br><a href="index.php?p=ShowSequence&id='.$Project.'">Clique aqui</a> para ver a lista detalhada</p>');}?>
		
	
	
<fieldset style="height: 900px; height: auto"><legend><h2>Import Fasta File</h2></legend>
<form id="upload_form" enctype="multipart/form-data" method="post" action="index.php?p=Read_Fasta_File&action=ImportFastaFile&id=<?php echo $id;?>">
	<input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>">
  	<input type="file" name="FastaFile" id="FastaFile" accept=".fasta, .fast, .fas"><br>
  	<input type="submit" title="Import Fasta File" value="Import Fasta File">
</form>	
</fieldset>	
</body>
</html>

