<?php
include('conection.php');
$action = $_GET["action"];
if ($action == "update"){
$id = $_GET["id"];
$query = "SELECT * FROM newprojects WHERE `Id_Project` = $id";
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>	
<style>
input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}	
#project {
background-color: #00a9de;
min-height: 250px;
width: 95%;
margin: 0 auto;
}
#textarea{
width: 90%;
height: 300px;
margin: 0 auto;	
}	
</style>
</head>
<body>	
<div id="project" class="card bg-dark form-group">
<form action="index.php?p=Operation_Project&action=<?php if ($action == "update"){echo($action);} else {echo("CdsNewProject");}?><?php if ($action == "update"){echo("&id=$id");}?>" method="POST">
<div class="card-title bg-dark text-white mb-3 text-center font-weight-lighter" style="font-family: monoscape; font-size: 25px"><?php if ($action == "update"){echo("Update description: "."<b>".$row["ProjectName"]."</b>");}?></div>	
<label for="" class="text-white"><h3 style="padding: 15px 15px 0 25px;">Project Name:</h3></label>
<input name="ProjectName" type="text" autofocus="autofocus" <?php if ($action == "update"){echo("disabled='disabled'");} else {}?> class="form-control form-control-lg" id="ProjectName" placeholder="Insert project name here" pattern="^[a-zA-Z0-9_-]+$" title="Only letters and numbers" autocomplete="on" value="<?php if ($action == "update"){ echo($row["ProjectName"]);}?>" maxlength="42">
<small class="form-text text-muted" style="padding: 15px 15px 0 25px;"><?php if ($action == "update"){echo("<div class='alert alert-danger' role='alert'>It is not allowed to rename an already created project.</div>");} else {echo("<div class='alert alert-success' role='alert'>Project Name</div>");}?></small>	
<div class="card shadow-textarea">
<label for="Description"><h3 style="padding: 15px 15px 0 25px;">Description</h3></label>
<textarea class="form-control z-depth-1" name="Description" id="textarea" rows="3" placeholder="Description your Project" title="Description your Project"><?php if ($action == "update"){ echo($row["Description"]);}?></textarea>	
</div><br>

<div class="form-group">
<input class="form-control" type="submit" name="submit" id="submit" value="<?php if ($action == "update"){echo("Update");} else {echo("Register");}?>">
</div>	
</form>	
</div>	
</body>
</html>
