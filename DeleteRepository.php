<?php
$QueryData = ("SELECT * FROM repositories WHERE idRepository = '".$_GET["id"]."' AND RepositoryUser = '".$_SESSION['idUser']."'");
$ResultData = mysqli_query($mysqli, $QueryData);
while ($row = $ResultData->fetch_assoc()) {
$RepositoryName	= $row["RepositoryName"];
$Repository	= $row["CodRepository"];
}

?>
<div class="text-center text-white mb-5 mt-5"><h2>Delete Repository (<?php echo($RepositoryName);?>)</h2></div>
<p class="mt-3 h2 text-center text-white">Would you like to exclude the Repository: <b><?php echo($RepositoryName);?></b></p>
<p class="mt-3 h2 text-center text-white">Excluding a repository cannot be undone.</p>
<div class="input-group input-group-lg mb-5 mt-5 w-50 mx-auto">
<div class="input-group-text">
    <input name="ChkRepository" type="checkbox" class="form-check-input mt-0" id="Term" onClick="$('#SubmitRepository').attr('disabled',$('#ChkRepository').is(':checked'));">
  </div>
  <input type="text" disabled="disabled" class="form-control" value="I accept delete Repository <?php echo($RepositoryName);?>">
</div>
	
<div class="d-grid gap-2 col-6 mx-auto">	
<a id="SubmitRepository" class="btn btn-danger btn-lg disabled" href="index.php?p=Functions&Action=Delete&Repository=<?php echo($Repository);?>&KeyUser=<?php echo($_SESSION['KeyUser']);?>&id=<?php echo($_GET["id"]);?>" role="button"><i class="fa-solid fa-2x fa-trash-can"></i> Delete <?php echo($RepositoryName);?></a>
</div>
<script>
$(document).ready(function() {
$('#SubmitRepository').addClass("disabled");
$('input:checkbox').click(function() {
if ($(this).is(':checked')) {
$('#SubmitRepository').removeClass("disabled");
} else {
if ($('.checks').filter(':checked').length < 1){
$('#SubmitRepository').addClass("disabled");}
}
});
});
</script>