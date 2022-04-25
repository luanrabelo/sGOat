<?php
$Action = $_GET["Action"];
if($Action == "CDS"){
?>
<div class="h2 text-center text-white mt-5">Create a new Repository</div>
<form class="w-50 mx-auto mt-5" action="index.php?p=Functions&Action=CDSNewRepository" method="POST" id="CDSNewRepository">
<div class="form-group">	
<label class="text-white">Repository Name</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fa-solid fa-2x fa-database"></i>
</div>	
</div>
<input name="RepositoryName" type="text" required="required" class="form-control mx-auto" id="RepositoryName" maxlength="75">	
</div>	
</div>	
<div class="form-group">	
<label class="text-white">Repository Description</label>	
<div class="input-group mb-5">
<textarea name="RepositoryDescription" rows="5" class="form-control form-control-lg" id="RepositoryDescription" placeholder=""></textarea>		
</div>	
</div>
<div class="d-grid gap-2">
<button type="submit" class="btn btn-block btn-success btn-lg btn-block">Save Repository</button>	
</div>
</form>
<?php } ?>
<?php
if($Action == "Update"){
$id 		= $_GET["id"];
$SqlQuery 	= ("SELECT * FROM repositories WHERE idRepository = '$id'");
$Result 	= mysqli_query($mysqli, $SqlQuery);
while ($RowData = mysqli_fetch_array($Result)) {
$Name 			= $RowData["RepositoryName"];
$Description 	= $RowData["RepositoryDescription"];
}
?>
<div class="h2 text-center text-white mt-5">Edit a Repository <?php echo($Name);?></div>
<form class="w-50 mx-auto mt-5" action="index.php?p=Functions&Action=UpdateRepository&id=<?php echo($id);?>" method="POST" id="UpdateRepository">
<div class="form-group">	
<label class="text-white">Repository Name</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fa-solid fa-2x fa-database"></i>
</div>	
</div>
<input name="RepositoryName" type="text" required="required" class="form-control mx-auto" id="RepositoryName" value="<?php echo($Name);?>" maxlength="75">	
</div>	
</div>	
<div class="form-group">	
<label class="text-white">Repository Description</label>	
<div class="input-group mb-5">
<textarea name="RepositoryDescription" rows="5" class="form-control form-control-lg" id="RepositoryDescription" placeholder=""><?php echo($Description);?></textarea>		
</div>	
</div>
<button type="submit" class="btn btn-success btn-lg btn-block">Update Repository</button>	
</form>
<?php } ?>