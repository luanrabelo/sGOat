<?php
$idRepository 	= $_GET["idRepository"];
$idUser 		= $_SESSION['idUser'];

$database = "CREATE TABLE IF NOT EXISTS swissprot(
   id INT NOT NULL AUTO_INCREMENT,
   Date VARCHAR(20) NULL,
   PRIMARY KEY ( id )
);";
mysqli_query($mysqli, $database) or die (mysql_error());

$Search 	= mysqli_query($mysqli, "SELECT * FROM swissprot WHERE id = '1'");
$Rows 		= mysqli_num_rows($Search);
if($Rows == "0"){
echo("Luan");
$data = ('INSERT INTO swissprot (`Date`) VALUES ("1990-09-20 12:12:12")');
mysqli_query($mysqli, $data);
}	

$Query 		= ("SELECT * FROM repositories WHERE idRepository = '$idRepository' AND RepositoryUser = '$idUser'");
$Result 	= mysqli_query($mysqli, $Query);
while ($rowName = $Result->fetch_assoc()) {
$RepositoryName = $rowName["RepositoryName"];
$RepositoryCod	= $rowName["CodRepository"];
$RepositoryDescription = $rowName["RepositoryDescription"];
}
$QueryData = ("SELECT * FROM repodata WHERE idRepository = '$idRepository' AND idUser = '$idUser'");
$ResultData = mysqli_query($mysqli, $QueryData);
while ($row = $ResultData->fetch_assoc()) {
$Sequences	= $row["Sequences"];
$Status		= $row["Status"];
$Blasted 	= $row["Blasted"];
$Result 	= $row["Result"];
$Annotation = $row["Annotation"];
$NoResult 	= $row["NoResult"];
}

?>
<style type="text/css">
@keyframes ldio-5u9mvyjadya-1 {
    0% { transform: rotate(0deg) }
   50% { transform: rotate(-45deg) }
  100% { transform: rotate(0deg) }
}
@keyframes ldio-5u9mvyjadya-2 {
    0% { transform: rotate(180deg) }
   50% { transform: rotate(225deg) }
  100% { transform: rotate(180deg) }
}
.ldio-5u9mvyjadya > div:nth-child(2) {
  transform: translate(-15px,0);
}
.ldio-5u9mvyjadya > div:nth-child(2) div {
  position: absolute;
  top: 50px;
  left: 50px;
  width: 150px;
  height: 75px;
  border-radius: 150px 150px 0 0;
  background: #000000;
  animation: ldio-5u9mvyjadya-1 1s linear infinite;
  transform-origin: 75px 75px
}
.ldio-5u9mvyjadya > div:nth-child(2) div:nth-child(2) {
  animation: ldio-5u9mvyjadya-2 1s linear infinite
}
.ldio-5u9mvyjadya > div:nth-child(2) div:nth-child(3) {
  transform: rotate(-90deg);
  animation: none;
}@keyframes ldio-5u9mvyjadya-3 {
    0% { transform: translate(237.5px,0); opacity: 0 }
   20% { opacity: 1 }
  100% { transform: translate(87.5px,0); opacity: 1 }
}
.ldio-5u9mvyjadya > div:nth-child(1) {
  display: block;
}
.ldio-5u9mvyjadya > div:nth-child(1) div {
  position: absolute;
  top: 115px;
  left: -10px;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #000000;
  animation: ldio-5u9mvyjadya-3 1s linear infinite
}
.ldio-5u9mvyjadya > div:nth-child(1) div:nth-child(1) { animation-delay: -0.67s }
.ldio-5u9mvyjadya > div:nth-child(1) div:nth-child(2) { animation-delay: -0.33s }
.ldio-5u9mvyjadya > div:nth-child(1) div:nth-child(3) { animation-delay: 0s }
.loadingio-spinner-bean-eater-d7ai1rnktyt {
  width: 250px;
  height: 250px;
  display: inline-block;
  overflow: hidden;
  background: none;
}
.ldio-5u9mvyjadya {
  width: 100%;
  height: 100%;
  position: relative;
  transform: translateZ(0) scale(1);
  backface-visibility: hidden;
  transform-origin: 0 0; /* see note above */
}
.ldio-5u9mvyjadya div { box-sizing: content-box; }
/* generated by https://loading.io/ */
</style>


<div class="modal fade" id="DownloadFastaFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
<div class="modal-content">
<div class="modal-header bg-dark text-white"><h3 class="modal-title">Download Fasta File</h5></div>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<div class="h3 text-center">Choose Fasta File to Download</div>
<div class="row row-cols-3 text-center">
<div class="col-4 mb-3 mt-3"><a class="btn btn-lg w-75 btn-primary" href="DownloadFasta.php?table=<?php echo($RepositoryCod);?>&KeyUser=<?php echo($_SESSION['KeyUser']);?>" role="button">Download Original Fasta File</a></div>	
<div class="col-4 mb-3 mt-3"><a class="btn btn-lg w-75 btn-primary" href="DownloadFastaAnnotation.php?table=<?php echo($RepositoryCod);?>&KeyUser=<?php echo($_SESSION['KeyUser']);?>" role="button">Download Fasta File with Annotation</a></div>
<div class="col-4 mb-3 mt-3"><a class="btn btn-lg w-75 btn-primary" href="DownloadFastaNoResults.php?table=<?php echo($RepositoryCod);?>&KeyUser=<?php echo($_SESSION['KeyUser']);?>" role="button">Download Fasta File without Annotation</a></div>
</div>
<div class="modal-footer bg-dark">
<button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


<div class="modal fade" id="Description" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
<div class="modal-content">
<div class="modal-header bg-dark text-white"><h3 class="modal-title">Repository: <b><?php echo($RepositoryName);?></b></h5></div>
<div style="line-height: 3.5;" class="modal-body text-center text-black h5"><?php echo($RepositoryDescription);?></div>
<div class="modal-footer bg-dark">
<button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<div class="modal fade" id="Blasting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
<div class="modal-content">
<div class="modal-header bg-dark text-white"><h3 class="modal-title">Blasting data, please wait...</h5></div>
<div style="line-height: 3.5;" class="modal-body text-center text-black h5"><div class="loadingio-spinner-bean-eater-d7ai1rnktyt"><div class="ldio-5u9mvyjadya">
<div><div></div><div></div><div></div></div><div><div></div><div></div><div></div></div>
</div></div></div>
</div>
</div>
</div>

<div class="modal fade" id="Download" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
<div class="modal-content">
<div class="modal-header bg-dark text-white"><h3 class="modal-title">Downloading Swissprot Database, please wait...</h5></div>
<div style="line-height: 3.5;" class="modal-body text-center text-black h5"><div class="loadingio-spinner-bean-eater-d7ai1rnktyt"><div class="ldio-5u9mvyjadya">
<div><div></div><div></div><div></div></div><div><div></div><div></div><div></div></div>
</div></div></div>
</div>
</div>
</div>

<div class="modal fade" id="Uniprot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
<div class="modal-content">
<div class="modal-header bg-dark text-white"><h3 class="modal-title">Analysing Swissprot Results, please wait...</h5></div>
<div style="line-height: 3.5;" class="modal-body text-center text-black h5"><div class="loadingio-spinner-bean-eater-d7ai1rnktyt"><div class="ldio-5u9mvyjadya">
<div><div></div><div></div><div></div></div><div><div></div><div></div><div></div></div>
</div></div></div>
</div>
</div>
</div>

<div class="modal fade" id="DownloadOK" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
<div class="modal-content">
<div class="modal-header bg-dark text-white"><h3 class="modal-title">Download Swissprot Database</h5></div>
<div style="line-height: 3.5;" class="modal-body text-center text-black h5"><img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">Download Swissprot Database done. Refreshing page in <span class="c" id="15"></span> seconds, please wait and Run Blast again</div>
</div>
</div>
</div>


<div class="modal fade" id="RunBlast" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-xl">
<div class="modal-content">
<div class="modal-header bg-dark text-white"><h5 class="modal-title">Blast Options</h5></div>
<div class="modal-body">
<div class="row row-cols-1 h3">
<div class="col">
<div class="input-group mb-3 form-select-lg">
<label class="input-group-text">BLAST Program: </label>
<select name="BlastApp" class="form-select" id="BlastApp">
<option value="blastx" selected>blastx</option>
<option value="blastp">blastp</option>
<option value="blastn">blastn</option>
</select>
</div>
</div>
<div class="col">
<div class="input-group mb-3 form-select-lg">
<label class="input-group-text">Database:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
<select name="BlastDatabase" class="form-select" id="BlastDatabase">
<?php
$DateSwissprot 	= ("SELECT * FROM swissprot WHERE id = '$idUser'");
$QuerySwissprot = mysqli_query($mysqli, $DateSwissprot);
while ($SwissprotRow = mysqli_fetch_array($QuerySwissprot)) {
if($SwissprotRow["Date"] == "1990-09-20 12:12:12"){
$DateLastUpdate = "swissprot database not found, click in Update Database to install";
} else {
$DateLastUpdate = "swissprot (update in: ".$SwissprotRow["Date"].")";
}
}
?>
<option value="swissprot" selected><?php echo($DateLastUpdate);?></option>
</select>
</div>	
</div>
<div class="col">
<div class="input-group mb-3 form-select-lg">
<label class="input-group-text">BLAST e-value: </label>
<select name="eValue" class="form-select" id="eValue">
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
</div>
<div class="col">
<div class="input-group mb-3 form-select-lg">
<span class="input-group-text">BLAST Hits:&nbsp;&nbsp;&nbsp;</span>
<input name="BlastHits" type="number" class="form-control" id="BlastHits" value="10">
</div>	
</div>
<div class="col">
<div class="input-group mb-3 form-select-lg">
<span class="input-group-text">BLAST CPU:&nbsp;&nbsp;&nbsp;&nbsp;</span>
<input name="BlastCPU" type="number" class="form-control" id="BlastCPU" value="2">
</div>	
</div>
</div>
</div>
<div class="modal-footer bg-dark">
<button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Close</button>
<button onClick="DownloadSwissprot();" type="button" class="btn btn-success btn-lg">Update Database</button>
<button onClick="Blast();" type="button" class="btn btn-primary btn-lg">Run BLAST</button>
</div>
</div>
</div>
</div>


<div class="mt-3">
<div class="row">
<div class="col-8">
<div class="card text-white bg-secondary mb-3">
<div class="card-body">
<div class="card-title h4"><b><?php echo($RepositoryName);?></b> <button type="button" class="btn btn-lg btn-outline-light ml-1 mr-1" data-toggle="tooltip" data-placement="top" title="Show Description" data-bs-toggle="modal" data-bs-target="#Description"><i style="color: black;" class="fa-solid fa-eye"></i></button> <a class="btn btn-lg btn-outline-light ml-1 mr-1" href="index.php?p=NewRepository&Action=Update&id=<?php echo($idRepository);?>" role="button" data-toggle="tooltip" data-placement="top" title="Edit this Repository"><i style="color: black" class="fa-solid fa-pen"></i></a></div>
<div class="input-group mb-3 input-group-lg">
<label class="input-group-text">Show sequences: </label>
<select onChange="LoadSequences();" id="CountSeq" class="form-select">
<?php
for($i = 1; $i <= ($Sequences/100); $i++){
echo('<option value="'.($i*100).'">'.($i*100).'</option>');
}
?>
<option value="<?php echo($Sequences);?>"><?php echo($Sequences);?> <?php if ($Sequences >= 1000) {echo("(Slow Loading)");}?></option>
</select>
</div>
<div class="row row-cols-3 mb-1 text-center">
<div class="col-sm-4"><button type="button" class="btn btn-lg mb-2 w-100 btn-primary <?php if($Status == "Annotated") {echo("disabled");} ?>" data-bs-toggle="modal" data-bs-target="#RunBlast">Run Blast</button></div>
<div class="col-sm-4"><button type="button" class="btn btn-lg mb-2 w-100 btn-info">Sequences <span class="badge bg-light text-black"><?php echo($Sequences);?></span></button></div>
<div class="col-sm-4"><button type="button" class="btn btn-lg mb-2 w-100 btn-info" data-toggle="tooltip" data-placement="top" title="Repository Status">Status <span class="badge bg-light text-black"><?php if($Status == "Blasting"){echo($Status.' <div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden"></span></div>');} else {echo($Status);}?></span></button></div>
<div class="col-sm-3"><button type="button" class="btn btn-lg mb-2 w-100 btn-dark" data-toggle="tooltip" data-placement="top" title="% Sequences Blasted">Blasted <span class="badge bg-light text-black"><?php if($Blasted != "--"){ echo(number_format(($Blasted*100)/$Sequences, 2))."%";} else {echo("--");}?></span></button></div>
<div class="col-sm-3"><button type="button" class="btn btn-lg mb-2 w-100 btn-dark" data-toggle="tooltip" data-placement="top" title="% Sequences With Blast Result">With Result <span class="badge bg-light text-black"><?php if($Result != "--"){ echo(number_format(($Result*100)/$Sequences, 2))."%";} else {echo("--");}?></span></button></div>
<div class="col-sm-3"><button type="button" class="btn btn-lg mb-2 w-100 btn-success" data-toggle="tooltip" data-placement="top" title="% Sequences With Annotation">With Annotation <span class="badge bg-light text-black"><?php if($Annotation != "--"){ echo(number_format(($Annotation*100)/$Sequences, 2))."%";} else {echo("--");}?></span></button></div>
<div class="col-sm-3"><button type="button" class="btn btn-lg mb-2 w-100 btn-danger" data-toggle="tooltip" data-placement="top" title="% Sequences without Blast Result">No Result <span class="badge bg-light text-black"><?php if($NoResult != "--"){ echo(number_format(($NoResult*100)/$Sequences, 2))."%";} else {echo("--");}?></span></button></div>
</div>
</div>
</div>
</div>
  
<div class="col-4">
<div class="card text-white bg-secondary mb-3">
<div class="card-body">
<div class="card-title h4">Export Results</div>
<div class="row row-cols-2 mb-2 text-center">
<div class="col-sm-6"><button type="button" class="btn btn-lg mb-2 w-100 btn-primary" data-bs-toggle="modal" data-bs-target="#DownloadFastaFile">Download Fasta File</button></div>
<div class="col-sm-6"><a class="btn btn-lg mb-2 w-100 btn-primary" href="WEGOFile.php?table=<?php echo($RepositoryCod);?>&KeyUser=<?php echo($_SESSION['KeyUser']);?>" role="button">Download WEGO File</a></div>
<div class="col-sm-6"></div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" tabindex="-1" id="LoadingSequences">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-dark text-white">
<div class="modal-title text-center h4">Loading Sequences</div>
</div>
<div class="modal-body text-center">		

<div class="loadingio-spinner-bean-eater-d7ai1rnktyt"><div class="ldio-5u9mvyjadya">
<div><div></div><div></div><div></div></div><div><div></div><div></div><div></div></div>
</div></div>
	
</div>
<div class="modal-footer bg-dark text-white text-left"><div class="h5">Please wait...</div></div>
</div>
</div>
</div>

<div class="mx-auto input-group mb-3 mt-1">
<span class="input-group-text">Term to search: </span>
<input name="Search" type="text" class="form-control form-control-lg" id="Search" placeholder="i.e. insulin metabolic process or mitochondrion">
<select name="DataSearch" class="form-select" id="DataSearch">
 	<option value="LuanRabelo" selected>All columns</option>
	<option value="SeqName">Name</option>
  	<option value="Description">Description</option>
  	<option value="GONames">#GO</option>
  	<option value="GOFunction">Function</option>
</select>
<button id="LoadSequences" class="btn btn-lg btn-primary" type="button" onClick="LoadSequences();"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
</div>
<div id="TableSequences"></div>
<?php
if($Status == "Blast Done"){
?>
<script>
$(document).ready(function() {
setTimeout(function(){
$('#UniprotBTN').click();
}, 2500);	
});
</script>	
<?php	
}
?>
<script>
$(document).ready(function() {
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-tooltip="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
return new bootstrap.Tooltip(tooltipTriggerEl)
});	
$('#LoadSequences').click();
$("#Search" ).keyup(function() {
if($('#Search').val().length == 0) {
$('#LoadSequences').click();
}});
});
	
function LoadSequences(){
$('#LoadingSequences').modal('show');
var Sequences 		= document.getElementById("Search").value;
var RepositoryCod 	= "<?php echo($RepositoryCod);?>";
var idRepository 	= "<?php echo($idRepository);?>";
var idUser			= "<?php echo($idUser);?>";
var DataSearch		= document.getElementById("DataSearch").value;
var CountSequences	= $("#CountSeq").val();;
var xhr;
if (window.XMLHttpRequest) {
xhr = new XMLHttpRequest();
} else if (window.ActiveXObject) {
xhr = new ActiveXObject("Microsoft.XMLHTTP");
}
var data = "Sequences="+Sequences+"&RepositoryCod="+RepositoryCod+"&idRepository="+idRepository+"&idUser="+idUser+"&DataSearch="+DataSearch+"&CountSequences="+CountSequences;
xhr.open("POST", "Sequences.php", true); 
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
xhr.send(data);
xhr.onreadystatechange = display_data;
function display_data() {
if (xhr.readyState == 4) {
if (xhr.status == 200) {	   
document.getElementById("TableSequences").innerHTML = xhr.responseText;
$('#LoadingSequences').modal('hide');
} else {
alert('There was a problem with the request.');
}}}}

function DownloadSwissprot(){
$('#RunBlast').modal('hide');
$('#Download').modal('show');
$.ajax({
url: "DownloadData.php",
}).done(function() {
$('#Download').modal('hide');
$('#DownloadOK').modal('show');
function c(){
	var n=$('.c').attr('id');
    var c=n;
	$('.c').text(c);
	setInterval(function(){
		c--;
		if(c>=0){
			$('.c').text(c);
		}
        if(c==0){
            $('.c').text(n);
        }
	},1000);
}
c();
setInterval(function(){
c();
},1000);
setInterval('refreshPage()', 16000);
});
}
function refreshPage() {
location.reload(true);
}
</script>

<script>
function Uniprot(){
$('#Uniprot').modal('show');
$.ajax({
url: 'UniprotData.php',
type: 'POST',
data:{"Repository" : '<?php echo($RepositoryCod); ?>', "idUser" : '<?php echo($idUser); ?>', "idRepository" : '<?php echo($idRepository); ?>', "KeyUser" : '<?php echo($_SESSION['KeyUser']); ?>'},
success: function(data) { 
console.log(data);
if(data == 0){		
$('#Uniprot').modal('hide');
setTimeout(function(){
location.reload(true);
}, 2000);	
} else {
}}});}
</script>
<input id="UniprotBTN" onClick="Uniprot();" type="hidden">
<script>
function Blast(){
$('#RunBlast').modal('hide');
$('#Blasting').modal('show');
var Blast = document.getElementById("BlastApp").value;
var BlastDatabase = document.getElementById("BlastDatabase").value;
var eValue = document.getElementById("eValue").value;
var BlastHits = document.getElementById("BlastHits").value;
var BlastCPU = document.getElementById("BlastCPU").value;
$.ajax({
url: 'BlastSeq.php',
type: 'POST',
data:{"Repository" : '<?php echo($RepositoryCod); ?>', "idUser" : '<?php echo($idUser); ?>', "idRepository" : '<?php echo($idRepository); ?>', "KeyUser" : '<?php echo($_SESSION['KeyUser']); ?>', "Blast" : Blast, "BlastDatabase" : BlastDatabase, "eValue": eValue, "BlastHits" : BlastHits, "BlastCPU" : BlastCPU},
success: function(data) { 
console.log(data);
if(data == 0){		
$('#Blasting').modal('hide');
setTimeout(function(){
location.reload(true);
}, 2000);	
} else {
}}});}
</script>
