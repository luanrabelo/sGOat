<?php
include("Connection.php");
if (isset($_POST["Repository"])){
$Repository = $_POST["Repository"];
if (empty($Repository)) {
$sql = ("SELECT * FROM repositories");
} 
if (!empty($Repository)) {
$Repository = $_POST["Repository"];
$sql = ("SELECT * FROM repositories WHERE RepositoryName like '%$Repository%' OR RepositoryDescription like '%$Repository%'");
}
sleep(1);
    
$result = mysqli_query($mysqli, $sql);
$cont 	= mysqli_num_rows($result);
if ($cont != 0) {
$return.= '<div class="h3 text-center text-white mt-3 mb-3">Repositories (<b>'.$cont.'</b>)</div>';
$return.= '<div class="mt-3 mb-3 text-center"><a class="btn btn-outline-light" href="index.php?p=NewRepository&Action=CDS" data-toggle="tooltip" data-placement="top" title="Create a new Repository"><i class="fa-solid fa-2x fa-plus"></i></a></div>';
while ($row = mysqli_fetch_array($result)) {
$idRepository = $row["idRepository"];
$idUser = $row["idRepository"];
$return.= '<div class="card text-center w-75 mx-auto mb-4">';
$return.= '<div class="card-header bg-dark text-white h4"><b>Repository Name:</b> <i>'.$row["RepositoryName"].'</i></div>';
$return.= '<div class="card-body">';
$return.= '<h5 class="card-title"><b>Description: </b></h5>';
$return.= "<p class='card-text'>".$row["RepositoryDescription"]."</p>";
$return.= '<div class="row row-cols-4">';

$QueryData 	= ("SELECT * FROM repodata WHERE idRepository = '$idRepository'");
$DataResult = mysqli_query($mysqli, $QueryData);
$Data 		= mysqli_num_rows($DataResult);
while ($rowRepo = mysqli_fetch_array($DataResult)) {
$Sequences = $rowRepo["Sequences"];
}
if ($Data > 0 and $Sequences != "--") {
$Importbtn 	= "disabled";
$Show		= "";
} else {
$Importbtn 	= "";
$Show		= "disabled";
}
$return.= '<div class="col"><a href="index.php?p=UploadForm&idRepository='.$row["idRepository"].'" class="btn btn-primary w-100 '.$Importbtn.'" ><i class="fas fa-2x fa-file-import mr-2"></i> Import Fasta File</a></div>';
	
$return.= '<div class="col"><a href="index.php?p=ListSequences&idRepository='.$row["idRepository"].'" class="btn btn-primary w-100 '.$Show.'"><i class="fas fa-2x fa-eye mr-2"></i> Show Sequences</a></div>';
	
//$return.= '<div class="col"><a href="#" class="btn btn-primary w-100"><i class="fas fa-2x fa-info-circle mr-2"></i> Details</a></div>';
$return.= '<div class="col"><a href="index.php?p=NewRepository&Action=Update&id='.$row["idRepository"].' " class="btn btn-primary w-100"><i class="fas fa-2x fa-edit mr-2"></i> Edit</a></div>';
$return.= '<div class="col"><a href="index.php?p=DeleteRepository&id='.$row["idRepository"].'" class="btn btn-danger w-100"><i class="fas fa-2x fa-trash-alt mr-2"></i> Delete</a></div>';
$return.= '</div>';
$return.= '</div>';
$return.= '<div class="card-footer text-dark bg-light"><i class="fa-solid fa-calendar-days"></i> Created in <b>'.date_format(date_create($row["DateCreation"]), 'm/d/Y').'</b></div>';
$return.= '</div>';
}
echo($return);
} else {
echo ('<div class="text-center h2 text-white mt-5 mb-5">You have not any repositories in sGOat with term <b>"'.$Repository.'"</b>.</div>');
}
}
?>