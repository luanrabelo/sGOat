<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>. . : : s G O a t : : . .</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>	
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
<link rel="icon" type="image/png" href="img/logo.jpg" />
<meta name="author" content="Luan Rabelo">
<meta property="og:title" content=" s G O a t " />
<meta property="og:url" content="https://luanrabelo.bio.br/sGOat" />
<meta property="og:description" content="sGOat: A New Web-Based Tool For Transcriptome Data Annotation and Post-Filtering Sequence Analysis in No-Model Organism | Developer: Luan Rabelo; Collaborators: Marcelo Vallinoto, Cristiana Maciel, Murilo Maciel, Davidson Sodré, Iracilda Sampaio;">
<meta property="og:image" content="img/logo.png" />
<link rel="stylesheet" href="sGOat.css"> 
</head>

<body class="font-monospace text-white bg-black mx-auto">
	
<main>
<?php
$pagina['NewUser'] 		= "CDSFormUser.php";
$pagina['Functions']	= "Functions.php";
$pagina['Recover'] 		= "RecoverPass.php";	
$pagina['NewPassword'] 	= "NewPassword.php";		
$pagina['UpdatePass'] 	= "UpdatePass.php";			
if (isset($_GET["p"])){
$link = $_GET["p"];
if (file_exists($pagina[$link])){
include_once $pagina[$link];
} else {
die (include_once 'PageNotFound.php');
}} else {
include("LoginForm.php");		
}	
?>
</main>	
</body>
</html>
