<?php
include("connection.php");
$Gene 	= $_POST["txtGene"];
$Term 	= $_POST["inputTerm"];
$idGene = $_GET["id"];
highlight_string($Gene);
$ProjGene	  = "SELECT * FROM projetos WHERE Project_Name = '".$idGene."' AND $Term LIKE '%$Gene%'";
$qryGene	  = $mysqli->query($ProjGene);
$Total_Gene	  = mysqli_num_rows($qryGene);

$ProjGeneAnno = "SELECT * FROM projetos WHERE Project_Name = '".$idGene."' AND $Term LIKE '%$Gene%' AND GO_Annotation = 'Annotation'";
$qryGeneAnno  = $mysqli->query($ProjGeneAnno);
$Total_Anno	  = mysqli_num_rows($qryGeneAnno);


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
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})	
</script>
</head>
<body>
<a href="javascript:history.back()">Back</a>
	<div style="max-width: 500%; overflow-Y: hidden;">
	<fieldset style="width: 75%; margin: 0 auto;">	
	<div class="input-group input-group-lg"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-lg">Search:</span>
  </div>
 <input type="text" class="form-control" value="<?php echo $Gene;?>" aria-describedby="inputGroup-sizing-sm" aria-label="Large">
</div><br>	
	<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Export to Fasta</h5>
        <p class="card-text">Export results <b>&quot;<?php echo($Gene);?>&quot;</b> to fasta.</p>
        <a href="DownSeq.php?id=<?php echo $idGene;?>&query=<?php echo $Gene;?>&action=search" class="btn btn-primary btn-lg">Export to Fasta</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Export to WEGO</h5>
        <p class="card-text">Export results <b>&quot;<?php echo $Gene; ?>&quot;</b> to WEGO file</p>
        <a href="export_wego.php?action=exportWEGO&id=<?php echo $idGene; ?>&txtGene=<?php echo $Gene; ?>" class="btn btn-primary btn-lg">Export to WEGO</a>
      </div>
    </div>
  </div>	
</div>	
<br>	
<div class="card text-center">
  <div class="card-body">Genes founds: <b><?php echo $Total_Gene; ?></b> | Genes with annotations <b><?php echo ($Total_Anno); ?></b></div></div><br>		
</fieldset>
	<div class="w3-container">
	<table align="center" class="w3-table-all w3-hoverable">
  <tbody>
    <tr class="w3-grey">
      <td width="auto" align="center">Sequence Name</td>
	  <td width="auto" align="center">Sequence</td>
	  <td width="auto" align="center">Description</td>
      <td width="auto" align="center">Length </td>
	  <td width="auto" align="center">#Hits</td>
	  <td width="auto" align="center">e-Value</td>
	  <td width="auto" align="center">sim mean</td>
      <td width="auto" align="center">#GO</td>
      <td width="auto" align="center">GO Names</td>
    </tr>
	  <?php
$query = "SELECT * FROM projetos WHERE Project_Name = '".$idGene."' AND $Term LIKE '%$Gene%'";
$result = $mysqli->query($query);
while ($row = $result->fetch_assoc()) {
?>
    <tr>
	  <div class="tooltip w3-tooltip">	
      <td align="center" data-toggle="tooltip" data-placement="right" title="<?php echo ($row["SeqNames"]);?>"><?php echo mb_strimwidth($row["SeqNames"], 0, 15, "...");?></td>
	  </div>	  
      <td align="center"><?php echo mb_strimwidth($row["Seq"], 0, 25, "...");?></td>
      <td align="center"><?php echo mb_strimwidth($row["Description"], 0, 50, "...");?></td>
      <td align="center"><?php echo strlen($row["Seq"]);?></td>
      <td align="center"><a href="index.php?p=Lst_Seq&idProject=<?php echo $row["Project"];?>&ProjectName=<?php echo $row["Project_Name"];?>"><?php echo $row["Hits"];?></a></td>
      <td align="center"><?php echo evfmt($row["eValue"]);?></td>
      <td align="center"><?php echo ($row["simmean"]);?></td>
      <td align="center"><?php echo mb_strimwidth($row["GO"], 0, 14, "...");;?></td>
	  <td align="center"><?php echo ($row["GO_Names"]);?></td>
    </tr>
	  <?php }; ?>
  </tbody>
</table>
</div>
</body>
</html>
