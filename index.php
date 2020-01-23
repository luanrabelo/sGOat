<?php 
include("conection.php");
$Soft_Name		= "sGOat Software Gene Ontology Annotation Transcriptome";
$Soft_Url		= "";
$Soft_Descr		= "";
function convert($size)
{
    $unit=array('b','kb','MB','GB','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

$start_time = microtime(TRUE);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $Soft_Name; ?></title>
<meta property="og:title" content="<?php echo $Soft_Name; ?>" />
<meta property="og:url" content="<?php echo $Soft_Url; ?>" />
<meta property="og:description" content="<?php echo $Soft_Descr; ?>">
<meta property="og:image" content="img/goat.png" />
<meta name="author" content="Luan Rabelo">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="img/goat.png" type="image/x-icon" />
<link rel="shortcut icon" href="img/organism.png" type="image/x-icon" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-3.3.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>	
</head>
<body>
	
<div class="bg-dark">
<div class="card">
<div class="card-header bg-dark text-white text-center">
<p style="font-size: 50px;"><b>sGOat</b></p>
<p></p>	
<p><strong style="font-size: 45px;">S</strong>oftware<b style="font-size: 45px;"> G</b>ene <b style="font-size: 45px;">O</b>ntology <b style="font-size: 45px;">A</b>nnotation <b style="font-size: 45px;">T</b>ranscriptome</td></p>
</div>	
</div>
</div>		
<div class="bg-info text-white text-center">
<ul class="nav nav-pills justify-content-center">
<div class="bg-primary" style="width: 250px"><li class="nav-item"><a href="index.php?p=Home" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Home</a></li></div>
<div class="bg-secondary" style="width: 250px">
<li class="nav-item">
<div class="btn-group dropdown">
<button class="btn btn-secondary btn-lg" type="button">Options</button>
<button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
<div class="dropdown-menu">
<a class="dropdown-item" href="index.php?p=NewProject">Create a new project</a>
<a class="dropdown-item" href="#">Config</a>
</div>
</div>  
</li>	
</div>	
<div class="bg-primary" style="width: 250px"><li class="nav-item"><a href="index.php?p=Manual" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Manual</a></li></div>	
<div class="bg-primary" style="width: 250px"><li class="nav-item"><a href="index.php?p=Contact" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Contact</a></li></div>
<div class="bg-primary" style="width: 250px"><li class="nav-item"><a href="index.php?p=About" class="btn btn-primary btn-lg" role="button" aria-disabled="true">About</a></li></div>	
</ul>	   
</div>
</div>
<br>
<?php

			$url 							= $_GET["p"];
			$pag["Home"]                    = "home.php";
			$pag["Read_Fasta_File"]      	= "Read_Fasta_File.php";
			$pag["About"]              		= "About.php";
			$pag["NewProject"]              = "Project.php";
			$pag["ShowSequence"]   			= "lst.php";
		  	$pag["Contact"]		            = "Contact.php";
		  	$pag["Fasta"]				    = "fasta.php";
			$pag["Operation_Project"]  		= "op_Project.php";
			$pag["Lst_Seq"]			  		= "lst_seq.php";
			$pag["Blast"]			  		= "blast.php";
			$pag["xml_Verify"]			  	= "xml_verify.php";
			$pag["Get_Seqs"]			  	= "GetSeq.php";
			$pag["InterPro"]			  	= "InterPro.php";
			$pag["Info"]				  	= "info.php";
			$pag["DownSeq"]				  	= "DownSeq.php";
			$pag["UniProt"]				  	= "verify_uniprot.php";
			$pag["Buscar"]                  = "buscar.php";
			$pag["BLAST-Options"]           = "options.php";
			$pag["UploadFasta"]	            = "upload.php";
			$pag["Manual"]	           		= "manual.php";
			
			if (!empty ($url)){
				if (file_exists($pag[$url]))
				{
					include $pag[$url];
					}
					else{
						include ("home.php");

						}}
						else{
							include ("home.php");
							}
	?>
<footer>
<p align="center"><small>Page generated in <b><?php $load = microtime();print (number_format($load,2));?></b> ms. | <?php
$end_time = microtime(TRUE);
$time_taken =($end_time - $start_time);
$time_taken = round($time_taken,5);
$LoadPage = number_format($time_taken, 4);
echo 'Page loaded in<b> '.$LoadPage.'</b> seconds.';
?> | Date: <b><?php $date = date_create($row["data"]); echo date_format($date, 'd/m/Y');?></b> | Memory usage: <b><?php echo convert(memory_get_usage(true));?></b></small></p>
</footer>
</body>
</html>
