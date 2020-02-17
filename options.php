<?php
$id 		= $_GET["id"];
$tCount		= $_GET["Start"];
$tCountM 	= $_GET["Qtde_Seq"];
$i			= $_GET["Start"];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>	
</head>

<body>
<fieldset style="width: 75%; margin: 0 auto;">
<legend></legend>
<div class="card text-center text-white bg-secondary border-dark mb-3">
<div class="card-header">BLAST Options</div>	
<form action="index.php?p=Fasta" method="get" target="_blank" id="blast" class="w3-container">
<input name="p" type="hidden" id="p" value="Fasta">
<input name="id" type="hidden" id="id" value="<?php echo($id);?>">
<div class="input-group mb-3"><br>
<div class="input-group-prepend"><br>
<label class="input-group-text" for="inputGroupSelect01">BLAST Program &nbsp;&nbsp;</label>
</div>  
<select name="Program" id="Program" class="custom-select">
<option value="blastx">blastx</option>
<option value="blastp">blastp</option>
<option value="blastn">blastn</option>
</select>
</div>
<div class="input-group mb-3">
<div class="input-group-prepend">
<label class="input-group-text" for="inputGroupSelect01">BLAST Database&nbsp;&nbsp;</label>
</div>  
<select name="DataBase" id="DataBase" class="custom-select">
<option value="swissprot">swissprot</option>
<option value="nr">nr</option>
<option value="nt">nt</option>
</select>
<small style="vertical-align: middle">&nbsp;&nbsp;Database update in:&nbsp;</small><br>
<small style="vertical-align: middle"></small>	
</div>
<div class="input-group mb-3">
<div class="input-group-prepend">
<label class="input-group-text" for="inputGroupSelect01">BLAST e-value&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
</div>  
<select name="evalue" id="evalue" class="custom-select">
<option value="1000">1000</option>
<option value="10" selected="selected">10</option>
<option value="5">5</option>
<option value="1">1</option>
<option value="0.1">0.1</option>
<option value="1.0E-3">1.0E-3</option>
<option value="1.0E-5">1.0E-5</option>
<option value="1.0E-10">1.0E-10</option>
<option value="1.0E-15">1.0E-15</option>
<option value="1.0E-25">1.0E-25</option>
<option value="1.0E-50">1.0E-50</option>
<option value="1.0E-75">1.0E-75</option>
<option value="1.0E-100">1.0E-100</option>
</select>
</div>
<div class="input-group mb-3">
<div class="input-group-prepend">
<label class="input-group-text" for="inputGroupSelect01">BLAST Hits&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
</div>  
<input name="Hits" type="number" id="Hits" value="20" class="form-c">
</div>

<div class="input-group mb-3">
<div class="input-group-prepend">
<label class="input-group-text" for="inputGroupSelect01">BLAST CPU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
</div>  
<input name="CPU" type="number" id="CPU" value="20" class="form-c">
</div>	
<p>
  <input name="Start" type="hidden" id="Start" value="<?php echo($tCount);?>">
  <input name="Qtde_Seq" type="hidden" id="Qtde_Seq" value="<?php echo($tCountM);?>">
  <input name="i" type="hidden" id="i" value="<?php echo($i);?>">	
  <input type="submit" value="START">
  </p>
<p></p>
</form>
</div>
</div>	
</fieldset>
</body>
</html>