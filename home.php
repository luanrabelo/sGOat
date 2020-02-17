<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
<link rel="stylesheet" type="text/css" href="css/blast.css"/>
<style>
#project {
background-color: #00a9de;
min-height: 250px;
width: 80%;
margin: 0 auto;
}
#button:hover {
cursor: pointer;
background-color: #E89A4C;	
}
#button{
font-size: 20px;
vertical-align: middle;
font-family: monospace;
width: 275px;
height: 45px;}
#description{
vertical-align: middle;
width: 100%;
height: 100%;
}
</style>	
</head>
<body>
<br>
<fieldset style="margin: 0 auto"><legend align="center">List Projects</legend>
<?php
$query = "SELECT * FROM newprojects ORDER BY Id_Project DESC";
$result = $mysqli->query($query);
while ($row = $result->fetch_assoc()) {
?>

<div id="project" class="card">
<div style="font-family: monoscape;" class="card-header bg-dark text-white mb-3 text-center"><img src="https://cdn1.iconfinder.com/data/icons/science-and-technology-1-6/512/45-512.png" width="50" height="50" alt=""/><b>Project Name:</b> <?php echo $row["ProjectName"];?></div>	
  <div class="row"> 
    <div class="col-sm text-center">
	<img class="rounded mx-auto d-block" src="https://ijcnlp2008.org/images/dna-clipart-dna-symbol-8.png" width="250" height="250" alt="Card image cap">	
	</div>
	<div class="col-sm text-white bg-dark mb-2">
	<b style="font-family: monospace; text-align: justify;">Description:</b><br><br><?php echo mb_strimwidth((wordwrap($row["Description"], 75, "<br>", true)), 0, 600, "...");?><br><div style="justify-content: flex-end; display: flex; bottom: 20px; right: 20px; position:absolute;"><button type="button" class="btn btn-outline-warning align-bottom" data-toggle="modal" data-target="<?php echo "#".$row["ProjectName"];?>">more details</button></div>
	</div>
<div class="modal fade bd-example-modal-lg" id="<?php echo $row["ProjectName"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-white bg-dark">
        <h5 class="modal-title text-center" id="exampleModalCenterTitle">Description of <b><?php echo $row["ProjectName"];?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><?php echo $row["Description"];?></div>
      <div class="modal-footer text-white bg-dark">
        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  
	<div class="col-sm text-right mb-3">
	<p></p>	
	<p><a id="button" class="btn btn-dark" href="index.php?p=Read_Fasta_File&id=<?php echo ($row["Id_Project"]);?>" role="button">Import Sequences</a></p>  
	<p><a id="button" class="btn btn-dark" href="index.php?p=ShowSequence&id=<?php echo ($row["Id_Project"]);?>" role="button">Show Sequences</a></p> 
	<p><a id="button" class="btn btn-dark" href="index.php?p=NewProject&action=update&id=<?php echo ($row["Id_Project"]);?>" role="button" onClick="return confirm('Deseja editar o Projeto <?php echo $row["ProjectName"];?> ?');">Edit Project</a></p>	
	<p><a id="button" class="btn btn-dark" href="index.php?p=Info&id=<?php echo ($row["Id_Project"]);?>" role="button">Details</a></p> 	
	<p><a id="button" class="btn btn-dark" href="index.php?p=Operation_Project&action=Delete&Id_Project=<?php echo $row["Id_Project"];?>" role="button" onClick="return confirm('Deseja Excluir o Projeto <?php echo $row["ProjectName"];?> ?');">Delete Project</a></p> 	
	</div>
  </div>	
<div class="card-footer bg-dark text-white">Created at: <?php $date = date_create($row["data"]); echo date_format($date, 'd/m/Y g:i:s A'); ?></div>
</div>	
<br>	
<?php };?>
</fieldset>
</body>
</html>
