<?php
include("Connection.php");

function evalue($evalue) {
$x = (float)sprintf("%.1e", $evalue);
if (preg_match("/e-/i", $x)) {
$y = explode("E-", $x);
if ($y[1] < 10) return round($y[0]) . "e-0" . $y[1];
else return round($y[0]) . "e-" . $y[1];
} else {
if (preg_match("/\./", $x)) {
if ($x * 1000 < 1): return round($x * 10000) . "e-04";
else: return $x; endif;
} else {
return $x . ".0";
}
}}

if (isset($_POST["Sequences"])){
$Sequences 		= $_POST["Sequences"];
$RepositoryCod 	= $_POST["RepositoryCod"];
$idRepository	= $_POST["idRepository"];
$idUser			= $_POST["idUser"];
$CountSequences = $_POST["CountSequences"];
if (empty($Sequences)) {
$Current 		= filter_input(INPUT_GET,'Page', FILTER_SANITIZE_NUMBER_INT);		
$Page 			= (!empty($Current)) ? $Current : 1;
$Results 		= $CountSequences;
$StarPage 		= ($Results * $Page) - $Results;
$QueryPage 		= ("SELECT * FROM $RepositoryCod WHERE idRepository = '$idRepository' AND idUser = '$idUser' LIMIT $StarPage, $Results");
$DataResult 	= mysqli_query($mysqli, $QueryPage);
while ($RowData = $DataResult->fetch_assoc()) {
	
$Modal .= '<div class="modal fade" id="ModalSequence_'.$RowData["id"].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';
$Modal .= '<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">';
$Modal .= '<div class="modal-content">';
$Modal .= '<div class="modal-header bg-dark text-white">';
$Modal .= '<h5 class="modal-title" id="staticBackdropLabel">'.$RowData["SeqName"].'</h5>';
$Modal .= '</div>';
$Modal .= '<div id="Sequence_'.$RowData["id"].'" class="modal-body lead">>'.$RowData["SeqName"].'<br>'.wordwrap($RowData["Seq"], 75,"\n", 1).'</div>';
$Modal .= '<div class="modal-footer bg-dark text-white">';
if ($RowData["Description"] != ""){
//$Modal .= '<button type="button" class="btn btn-lg btn-primary" data-tooltip="tooltip" data-bs-html="true" title="Download Sequence '. $RowData["Description"].'"><i class="fas fa-2x fa-file-download"></i> Download Fasta</button>';	
} else {
//$Modal .= '<button type="button" class="btn btn-lg btn-primary" data-tooltip="tooltip" data-bs-html="true" title="Download Sequence '. $RowData["SeqName"].'"><i class="fas fa-2x fa-file-download"></i> Download Fasta</button>';
}
$Modal .= '<button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal" data-tooltip="tooltip" data-bs-html="true" title="<b>Close this content</b>"><i class="fas fa-2x fa-window-close"></i> Close</button>';
$Modal .= '</div>';
$Modal .= '</div>';
$Modal .= '</div>';
$Modal .= '</div>';
}
$Table .= '<table class="table table-light table-striped table-hover table-bordered text-center mt-2 mb-5 align-middle">';
$Table .= '<tbody>';
$Table .= '<tr>';
$Table .= '<td>#</td>';
$Table .= '<td>Name</td>';
$Table .= '<td>Sequence</td>';
$Table .= '<td>Description</td>';
$Table .= '<td>Length (bp)</td>';
$Table .= '<td>%GC</td>';
$Table .= '<td>#Hits</td>';
$Table .= '<td>e-value</td>';
$Table .= '<td>#GO</td>';
$Table .= '<td>Function</td>';
$Table .= '</tr>';
	
$Current 		= filter_input(INPUT_GET,'Page', FILTER_SANITIZE_NUMBER_INT);		
$Page 			= (!empty($Current)) ? $Current : 1;
$Results 		= $CountSequences;
$StarPage 		= ($Results * $Page) - $Results;
$QueryPage 		= ("SELECT * FROM $RepositoryCod WHERE idRepository = '$idRepository' AND idUser = '$idUser' LIMIT $StarPage, $Results");
$DataResult 	= mysqli_query($mysqli, $QueryPage);
while ($row = $DataResult->fetch_assoc()) {
if ($row["Status"] == "Result" or $row["Status"] == "NoAnnot" and $row["Description"] != "") { $Table .= "<tr class='table-success'>";}
if ($row["Status"] == "NoResult" and $row["Description"] == "-") { $Table .= "<tr class='table-danger'>";}
if ($row["Status"] == "Annotation") { $Table .= "<tr class='table-info'>";}
$Table .= '<td>'.$row["id"].'</td>';
$Table .= '<td>'.$row["SeqName"].'</td>';
if ($row["Description"] != ""){ 
	$Table .= '<td><button style="width: 60px;" type="button" class="btn btn-lg btn-dark" data-tooltip="tooltip" data-bs-html="true" title="Show Sequence '.$row["Description"].'" data-bs-toggle="modal" data-bs-target="#ModalSequence_'.$row["id"].'"><i class="fas fa-eye"></i></button></td>';
} else {
	$Table .= '<td><button style="width: 60px;" type="button" class="btn btn-lg btn-dark" data-tooltip="tooltip" data-bs-html="true" title="Show Sequence '.$row["SeqName"].'" data-bs-toggle="modal" data-bs-target="#ModalSequence_'.$row["id"].'"><i class="fas fa-eye"></i></button></td>';
} 	
$Table .= '<td>'.$row["Description"].'</td>';
$Table .= '<td>'.strlen($row["Seq"]).'</td>';
$Table .= '<td>'.number_format(((substr_count($row["Seq"],'G')+(substr_count($row["Seq"],'C')))*100)/strlen($row["Seq"]), 2)."%".'</td>';
$Table .= '<td>'.$row["Hits"].'</td>';
$Table .= '<td>'.evalue($row["eValue"]).'</td>';
$Table .= '<td>'.$row["GONames"].'</td>';
$Table .= '<td>'.$row["GOFunctions"].'</td>';
$Table .= '</tr>';	
}	
$Table .= '';
$Table .= '';
$Table .= '';
$Table .= '';
$Table .= '';
$Table .= '';
$Table .= '';
$Table .= '';
$Table .= '';
$Table .= '</tbody>';
$Table .= '</table>';
} 
if (!empty($Sequences)) {
$Sequences 	= $_POST["Sequences"];
$DataSearch = $_POST["DataSearch"];
	
$Table .= '<table class="table table-light table-striped table-hover table-bordered text-center mt-2 mb-5 align-middle">';
$Table .= '<tbody>';
$Table .= '<tr>';
$Table .= '<td>#</td>';
$Table .= '<td>Name</td>';
$Table .= '<td>Sequence</td>';
$Table .= '<td>Description</td>';
$Table .= '<td>Length (bp)</td>';
$Table .= '<td>%GC</td>';
$Table .= '<td>#Hits</td>';
$Table .= '<td>e-value</td>';
$Table .= '<td>#GO</td>';
$Table .= '<td>Function</td>';
$Table .= '</tr>';	
if($DataSearch == "LuanRabelo"){
$Query = ("SELECT * FROM $RepositoryCod WHERE idRepository = '$idRepository' AND idUser = '$idUser' AND SeqName like '%$Sequences%' OR Description like '%$Sequences%' OR Organism like '%$Sequences%' OR GONames like '%$Sequences%' OR GOFunctions like '%$Sequences%'");
} else {
$Query = ("SELECT * FROM $RepositoryCod WHERE idRepository = '$idRepository' AND idUser = '$idUser' AND $DataSearch like '%$Sequences%'");	
}
$ResultQuery 	= mysqli_query($mysqli, $Query);
while ($row = $ResultQuery->fetch_assoc()) {
if ($row["Status"] == "Result"  and $row["Description"] != "") { $Table .= "<tr class='table-success'>";}
if ($row["Status"] == "NoResult" and $row["Description"] == "-") { $Table .= "<tr class='table-danger'>";}
if ($row["GO_Annotation"] == "Annotation" and $row["GO"] == "-") { $Table .= "<tr class='table-info'>";}
$Table .= '<td>'.$row["id"].'</td>';
$Table .= '<td>'.$row["SeqName"].'</td>';
if ($row["Description"] != ""){ 
	$Table .= '<td><button style="width: 60px;" type="button" class="btn btn-lg btn-dark" data-tooltip="tooltip" data-bs-html="true" title="Show Sequence '.$row["Description"].'" data-bs-toggle="modal" data-bs-target="#ModalSequence'.$row["idRepository"].'"><i class="fas fa-eye"></i></button></td>';
} else {
	$Table .= '<td><button style="width: 60px;" type="button" class="btn btn-lg btn-dark" data-tooltip="tooltip" data-bs-html="true" title="Show Sequence '.$row["SeqName"].'" data-bs-toggle="modal" data-bs-target="#ModalSequence'.$row["idRepository"].'"><i class="fas fa-eye"></i></button></td>';
} 	
$Table .= '<td>'.$row["Description"].'</td>';
$Table .= '<td>'.strlen($row["Seq"]).'</td>';
$Table .= '<td>'.number_format(((substr_count($row["Seq"],'G')+(substr_count($row["Seq"],'C')))*100)/strlen($row["Seq"]), 2)."%".'</td>';
$Table .= '<td>'.$row["Hits"].'</td>';
$Table .= '<td>'.$row["eValue"].'</td>';
$Table .= '<td>'.$row["GONames"].'</td>';
$Table .= '<td>'.$row["GOFunctions"].'</td>';
$Table .= '</tr>';	
}	
$Table .= '</tbody>';
$Table .= '</table>';	
}
sleep(1);
echo($Modal.$Table);
}

?>