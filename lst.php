<?php
ini_set("memory_limit", "1024M");
ini_set('post_max_size', '1024M');
ini_set('upload_max_filesize', '1024M');
include("connection.php");
$Seq = $_GET["id"];

$Projetos	  = "SELECT * FROM projetos WHERE Project_Name = '".$Seq."'";
$qry 		  = $mysqli->query($Projetos);
$Total_Seq	  = mysqli_num_rows($qry);

//Calculate e-Value
function evfmt($Hsp_evalue) {
		$x = (float)sprintf("%.1e", $Hsp_evalue);
		if (preg_match("/e-/i", $x)) {
			$y = explode("E-", $x);
			if ($y[1] < 10) return round($y[0]) . "e-0" . $y[1];
			else return round($y[0]) . "e-" . $y[1];
		} else {
			if (preg_match("/\./", $x)) {
				if ($x * 1000 < 1): return round($x * 10000) . "e-04";
				else: return $x; endif;
			} else
				return $x . ".0";
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
<fieldset style="width: 90%; margin: 0 auto">
<div class="card border-0">
<?php
$query 		= "SELECT * FROM newprojects WHERE `Id_Project` = $Seq";
$result 	= $mysqli->query($query);
$NamePro	= mysqli_fetch_assoc($result);	
?>	
<div class="card-header bg-dark text-white text-center" style="font-family: monoscape;"><img src="https://cdn1.iconfinder.com/data/icons/science-and-technology-1-6/512/45-512.png" width="50" height="50" alt=""/><b><?php echo($NamePro["ProjectName"]);?></b></div>
		
<?php
$Count	  	= ("SELECT MIN(Project) AS count FROM projetos WHERE `Project_Name` = $Seq");
$qCount 	= $mysqli->query($Count);
$tCount		= mysqli_fetch_assoc($qCount);
$CountM	  	= ("SELECT MAX(Project) AS countM FROM projetos WHERE `Project_Name` = $Seq");
$qCountM 	= $mysqli->query($CountM);
$tCountM	= mysqli_fetch_assoc($qCountM);
?>	
<div class="row">
<div class="col-sm-6">
<div class="card border-dark">
<div class="card-body">
<h5 class="card-title">Options</h5>
<p class="card-text"><b><?php echo $Total_Seq; ?></b> Sequences</p>	
<div class="btn-group dropright">
<button class="btn btn-secondary btn-lg" type="button">Run sGOat</button>
<button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
<div class="dropdown-menu">	
<a class="dropdown-item" href="index.php?p=BLAST-Options&id=<?php echo($Seq);?>&Start=<?php echo ($tCount['count']);?>&Qtde_Seq=<?php echo ($tCountM['countM']);?>">Run Blast</a>
</div>
</div>
</div>
</div>
</div>
	
<div class="col-sm-6">
<div class="card border-dark">
<div class="card-body">
<h5 class="card-title">Export Results</h5>
<p class="card-text">User Information</p>
<div class="btn-group dropright">
<button class="btn btn-secondary btn-lg" type="button">Export Results</button>
<button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
<div class="dropdown-menu">
<div class="table-success">
<a class="dropdown-item" href="export_wego.php?action=Results&id=<?php echo($Seq);?>">Download Fasta File with Descriptions</a>
</div>
<div class="table-danger">	
<a class="dropdown-item" href="DownSeq.php?id=<?php echo $Seq;?>">Download Fasta File without any Description</a>
</div>	
<div class="table-info">	
<a class="dropdown-item" href="export_wego.php?action=exportWEGOall&id=<?php echo $Seq; ?>">Download WEGO File</a>
</div>	
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#"></a>
</div>
</div>
</div>
</div>
</div>
</div>
</div><br>	
<form action="index.php?p=Buscar&id=<?php echo($Seq);?>" method="post">
<div class="form-row align-items-center">
<div class="form-group col-md-8">	
<div class="input-group input-group-lg">
<div class="input-group-prepend">	
<span class="input-group-text" id="inputGroup-sizing-lg">Term to search: </span>
</div>
<input name="txtGene" type="text" class="form-control" id="txtGene" aria-describedby="inputGroup-sizing-lg" aria-label="Sizing example input">
</div></div> 
<div class="form-group col-md-3">	
<div class="input-group input-group-lg">
<div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-lg">in: </span></div>
<select name="inputTerm" class="form-control" id="inputTerm">
  <option value="Project">Nr</option>
  <option value="SeqNames">Name</option>
  <option value="Description">Description</option>
  <option value="GO">GO</option>
  <option value="GO_Names">Function</option>
</select>
</div></div>	  
<div class="form-group col">	
<button type="submit" class="btn btn-primary btn-lg btn-block">Search</button>
</div>	  
</div>	
</form>
</fieldset>
<div class="card">	
</div>	
<table width="90%" align="center" class="table">
<tbody>
<tr class="thead-dark text-center" style="font-size: 100%; font-weight: bolder">
<th scope="col" width="1%" align="center">Nr</td>
<th scope="col" width="4%" align="center">Name</td>
<th scope="col" width="1%" align="center">Sequence</td>
<th scope="col" width="20%"align="center">Description</td>
<th scope="col" width="1%" align="center">Length</td>
<th scope="col" width="1%" align="center">%GC</td>
<th scope="col" width="1%" align="center">#Hits</td>
<th scope="col" width="1%" align="center">e-value</td>
<th scope="col" width="1%" align="center">sim mean</td>
<th scope="col" width="10%"align="center">#GO</td>
<th scope="col" width="75%"align="center">Function</td>
</tr>
<?php
//Receber o número da página
$pagina_atual = filter_input(INPUT_GET,'pag', FILTER_SANITIZE_NUMBER_INT);		
$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
//Setar a quantidade de itens por pagina
$qnt_result_pg = 100;
//calcular o inicio visualização
$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
$query = "SELECT * FROM `projetos` WHERE Project_Name = '".$Seq."' LIMIT $inicio, $qnt_result_pg ";
$result = $mysqli->query($query);
while ($row = $result->fetch_assoc()) {
?>
<tr <?php if ($row["BlastStatus"] == "Blasted" and $row["GO_Annotation"] == "No Annotation" or "" or NULL or null) {echo "class='table-success'";} if ($row["Blast"] == "" or null or "No Hits" and $row["GO_Annotation"] == "" or null) {echo "class='table-danger'";} if ($row["GO_Annotation"] == "Annotation" and $row["Blast"] == "Hits"){echo "class='table-info'";} ?>>
<td align="center"><?php echo ($row["Project"]);?></td>
<td align="center"><div data-toggle="tooltip" data-placement="bottom" title="<?php echo $row["SeqNames"];?>"><?php echo mb_strimwidth($row["SeqNames"], 0, 10, "...");?></div></td>
	
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
	
<td align="center"><div data-toggle="tooltip" data-placement="bottom" title="<?php echo $row["Seq"];?>"><?php echo mb_strimwidth($row["Seq"], 0, 20, "...");?></div></td>
	
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
	
<td align="center" class="text-truncate"><div class="text-truncate" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row["Description"];?>"><?php echo mb_strimwidth($row["Description"], 0, 30, "...");?></div></td>
	
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<td align="center"><?php echo strlen($row["Seq"]);?></td>
<td align="center"><?php echo number_format(((substr_count($row["Seq"],'G')+(substr_count($row["Seq"],'C')))*100)/strlen($row["Seq"]), 1)."%";?></td>
<td align="center" style="text-decoration-color: white"><button type="button" class="btn btn-dark"><a href="index.php?p=Lst_Seq&idProject=<?php echo $row["Project"];?>&ProjectName=<?php echo $row["Project_Name"];?>"><?php echo $row["Hits"];?></a></button></td>
<td align="center"><?php if ($row["eValue"] == "-") {echo ($row["eValue"]);} else {echo evfmt($row["eValue"]);}?></td>
<td align="center"><?php echo number_format($row["simmean"], 1)."%";?></td>
<td align="center"><?php echo ($row["GO"]);?></td>
<td align="left"><?php echo ($row["GO_Names"]);?></td>
</tr>
<?php }; ?>
</tbody>
</table>
<?php
//Paginção - Somar a quantidade de usuários
$result_pg = "SELECT COUNT(Project) AS num_result FROM projetos WHERE Project_Name = '".$Seq."'";
$resultado_pg = mysqli_query($mysqli, $result_pg);
$row_pg = mysqli_fetch_assoc($resultado_pg);
//Quantidade de pagina 
$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
		
//Limitar os link antes depois
echo("<ul class='pagination pagination-lg justify-content-center'>");
$max_links = 10;
echo "<li class='page-item'><a class='page-link' href='index.php?p=ShowSequence&id=".$Seq."&pag=1'>First</a></li>";
for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
if($pag_ant >= 1){
echo "<li class='page-item'><a class='page-link' href='index.php?p=ShowSequence&id=".$Seq."&pag=$pag_ant'>$pag_ant</a></li>";
}}
echo ("<li class='page-item disabled'><a class='page-link' href='#'>$pagina</a></li>");
for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
if($pag_dep <= $quantidade_pg){
echo "<li class='page-item'><a class='page-link' href='index.php?p=ShowSequence&id=".$Seq."&pag=$pag_dep'>$pag_dep</a></li>";
}}
echo "<li class='page-item'><a class='page-link' href='index.php?p=ShowSequence&id=".$Seq."&pag=".$quantidade_pg."'>Last</a></li>";
echo("</ul>");
?>

</body>
</html>


