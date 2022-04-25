<?php
$Start = microtime(TRUE);
//session_save_path('/home/luanrabelo2/tmp');
session_start();
include("Connection.php");
if((!isset ($_SESSION['idUser']) == true) and (!isset ($_SESSION['FirstName']) == true) and (!isset ($_SESSION['LastName']) == true) and
(!isset ($_SESSION['Email']) == true) and (!isset ($_SESSION['Birthday']) == true) and (!isset ($_SESSION['KeyUser']) == true) and (!isset ($_SESSION['Assistance']) == true)) {   
unset($_SESSION['idUser']);
unset($_SESSION['FirstName']);
unset($_SESSION['LastName']);
unset($_SESSION['Email']);
unset($_SESSION['Birthday']);
unset($_SESSION['KeyUser']);
unset($_SESSION['Assistance']);
header('location:Login.php'); 
}
function convert($size)
{
    $unit = array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>. . : : s G O a t : : . .</title>
<meta property="og:title" content=". . : : s G O a t : : . ." />
<meta property="og:url" content="LINK" />
<meta property="og:description" content="DESCRIPTION">
<meta property="og:image" content="img/sgoat.png" />
<meta name="author" content="Luan Rabelo">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="img/sgoat.png" type="image/x-icon"/>
<link rel="shortcut icon" href="img/organism.png" type="image/x-icon" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/7d94912b47.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<style>
	.fa-2x, .fa-3x{vertical-align: middle;}	
	.breadcrumb {background-color: white; color: black; border-color: white; font-weight: bold;}
</style>

</head>	
<body class="bg-black container-fluid font-monospace">

<header>
<?php //include("Text.php"); ?>
<img src="img/logo.png" alt="sGOat" height="150" class="rounded mx-auto d-block">
<div class="h1 text-white text-center">sGOat</div>
<div class="h6 text-center text-white">Software Gene Ontology Annotation Transcriptome</div>
<?php include("Menu.php"); ?>
</header>
<?php include("Modal.php");?> 
<main>
<?php
$url 							= $_GET["p"];
$pag["Home"]                    = "Home.php";
$pag["UploadForm"]      		= "UploadForm.php";
$pag["ListSequences"]      		= "ListSequences.php";
$pag["NewRepository"]      		= "NewRepository.php";
$pag["Functions"]      			= "Functions.php";
$pag["Logout"]      			= "Logout.php";
$pag["DeleteRepository"]      	= "DeleteRepository.php";
if (!empty($url)){
if (file_exists($pag[$url])){
include $pag[$url];}
else{include ("PageNotFound.php");}
}else{include ("Home.php");}
?>
</main>	
<footer class="bg-white fixed-bottom text-center">
<small>Page generated in <b><?php $Load = microtime(); print (number_format($Load,2));?></b> ms. | <?php
$End = microtime(TRUE);
$time_taken =($End - $Start);
$time_taken = round($time_taken,5);
$LoadPage = number_format($time_taken, 4);
echo 'Page loaded in<b> '.$LoadPage.'</b> seconds.';
?> | Date: <b><?php $date = date_create($row["data"]); echo date_format($date, 'm/d/Y');?></b> | Memory usage: <b><?php echo convert(memory_get_usage(true));?></b></small>	
</footer>
<?php //include("Scripts.php");?>	
</body>
</html>
