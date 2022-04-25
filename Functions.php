<?php
require_once("Connection.php");
$Action 	= $_GET["Action"];
//session_save_path('/home/luanrabelo2/tmp');

function randString($size){
$basic = 'abcdefghijklmnopqrstuvwxyz';
$return= "";
for($count= 0; $size > $count; $count++){
$return.= $basic[rand(0, strlen($basic) - 1)];
}
return $return;
}

if ($Action == "CDSNewUser") {
$FirstName 		= $_POST['FirstName'];
$LastName 		= $_POST['LastName'];
$Institution 	= $_POST['Institution'];
$Birthday 		= $_POST['Birthday'];
$Email	 		= $_POST['Email'];
$Password 		= hash('sha512', $_POST['Password']);
$Date			= date("Y-m-d");
$KeyUser		= randString(50);

$Search 	= mysqli_query($mysqli, "SELECT * FROM users WHERE Email = '$Email' or KeyUser = '$KeyUser'");
$Rows 		= mysqli_num_rows($Search);
if(!$Rows > 0){ 	
$Sqli	=	("INSERT INTO users (`FirstName`, `LastName`, `Institution`, `Birthday`, `Email`, `Password`, `DateCreation`, `KeyUser`) VALUES ('$FirstName', '$LastName', '$Institution', '$Birthday', '$Email', '$Password', '$Date', '$KeyUser')");
if(mysqli_query($mysqli, $Sqli)){
mkdir("Users/$KeyUser", 0777, true);
?>
<div class="alert alert-success text-center mt-5" role="alert">
<div class="alert-heading h3">Well done!</div>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p>The User <?php echo($Email);?> has been successfully registered!</p>
<hr>
<p class="mb-0">Redirecting to Login page, please wait ...</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=index.php'>"); ?>	
<?php								 
}else{
?>
<div class="alert alert-danger text-center mt-5" role="alert">
<div class="alert-heading h3">Error to insert data</div>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p>Error to insert data in MYSQL, try again</p>	
<hr>
<p class="mb-0">Redirecting to the registration page, please wait ...</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=Login.php?p=NewUser'>"); 
}
?>	
<?php	
}else{
?>	
<div class="alert alert-danger text-center mt-5" role="alert">
<div class="alert-heading h3">Data Error</div>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p>The User <?php echo($Email);?> is already registered in sGOat.</p>	
<hr>
<p class="mb-0">Redirecting to Recover Password page, please wait ...</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=Login.php?p=Recover'>"); 
}}		
?>

<?php
if($Action == "UpdatePass"){
$KeyUser 		= $_GET["KeyUser"];
$Password 		= hash('sha512', $_POST['Password']);	
$Update = ("UPDATE users SET Password = '$Password' WHERE KeyUser = '$KeyUser'");
if(mysqli_query($mysqli, $Update)){
?>
<div class="alert alert-success text-center mt-5" role="alert">
<h4 class="alert-heading">Password Update!</h4>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p>Hello, your Password is updated!</p>
<hr>
<p class="mb-0">Loading Login Page</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=Login.php'>"); ?>
<?php
}else{
?>
<div class="alert alert-danger text-center mt-5" role="alert">
<h4 class="alert-heading">Error Password Update!</h4>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p>Hello, your Password is not updated!</p>
<hr>
<p class="mb-0">Loading Password Update Page</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=Login.php?p=NewPassword&KeyUser=$KeyUser'>"); ?>
<?php
}}
?>

<?php
if($Action == "CDSNewRepository"){
$RepositoryName 		= $_POST['RepositoryName'];
$Description 			= $_POST['RepositoryDescription'];
$Date					= date("Y-m-d");
$idUser					= $_SESSION['idUser'];
$KeyUser				= $_SESSION['KeyUser'];
$idRepository			= randString(50);
$search 	= mysqli_query($mysqli, "SELECT * FROM repositories WHERE RepositoryName = '$RepositoryName' and RepositoryUser = '$idUser'");
$num_rows 	= mysqli_num_rows($search);
if(!$num_rows > 0){	
	
$sqli	=	("INSERT INTO `repositories` (`RepositoryName`, `RepositoryDescription`, `RepositoryUser`, `CodRepository`, `DateCreation`) VALUES ('$RepositoryName', '$Description', '$idUser', '$idRepository', '$Date')");
	
if(mysqli_query($mysqli, $sqli)){
mkdir("Users/$KeyUser/$idRepository/upload", 0777, true);
mkdir("Users/$KeyUser/$idRepository/data", 0777, true);
mkdir("Users/$KeyUser/$idRepository/results", 0777, true);
mkdir("Users/$KeyUser/$idRepository/uniprot", 0777, true);
?>
<div class="alert alert-success text-center mt-5" role="alert">
<h3 class="alert-heading"><?php echo("Repository Created");?></h3>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p><?php echo("The Repository ".$RepositoryName." has been successfully created!");?></p>
<hr>
<p class="mb-0">Redirecting to the repositories page, please wait ...</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=index.php'>"); ?>	
<?php								 
}else{
?>
<div class="alert alert-danger text-center mt-5" role="alert">
<h3 class="alert-heading">Error to insert data</h3>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p>Error to insert data in MYSQL, try again</p>	
<hr>
<p class="mb-0">Redirecting to the Create Repository page, please wait...</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=index.php?p=NewRepository'>"); 
}
?>
<?php	
}else{
?>	
<div class="alert alert-danger text-center mt-5" role="alert">
<h3 class="alert-heading">Repository Duplicated</h3>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p>You have a <b>Repository Duplicated</b>, change the <b>Repository Name</b> and try again</p>	
<hr>
<p class="mb-0">Redirecting to the Create Repository page, please wait...</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '10;URL=index.php?p=NewRepository&Action=CDS'>"); 
}}	
?>

<?php
if($Action == "LoginUser"){
$Login			=	$_POST['Login'];
$Password 		= 	hash('sha512', $_POST['Pass']);
$sql			= ("SELECT * FROM `Users` WHERE Email = '".$Login."' and Password = '".$Password."'"); 
$resultados 	= mysqli_query($mysqli, $sql) or die (mysql_error());	
$res			= mysqli_fetch_array($resultados); 
if (mysqli_num_rows($resultados) == 0) {
sleep(2);
echo 0;

} else {	
session_start();	
$_SESSION['idUser']			= $res['idUser']; 		
$_SESSION['FirstName']		= $res['FirstName'];
$_SESSION['LastName']		= $res['LastName'];	
$_SESSION['Email']			= $res['Email'];	
$_SESSION['Birthday']		= $res['Birthday'];	
$_SESSION['KeyUser']		= $res['KeyUser'];
$_SESSION['Assistance']		= $_POST['Assistance'];

session_write_close();
	
sleep(2);	
echo 1;
exit;	
} 
}
?>
<?php
// Update Repository
if($Action == "UpdateRepository"){
$RepositoryName 		= $_POST['RepositoryName'];
$Description 			= $_POST['RepositoryDescription'];	
$id						= $_GET['id'];
$Update   = ("UPDATE `repositories` SET `RepositoryName` = '$RepositoryName',`RepositoryDescription` = '$Description' WHERE `idRepository` = '$id'");	
if(mysqli_query($mysqli, $Update)){
?>
<div class="alert alert-success text-center mt-5" role="alert">
<h3 class="alert-heading"><?php echo("Repository Updated!");?></h3>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p><?php echo("The Repository ".$RepositoryName." has been successfully edited!");?></p>
<hr>
<p class="mb-0">Redirecting to the repositories page, please wait ...</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=index.php'>"); ?>	
<?php								 
}else{
?>
<div class="alert alert-danger text-center mt-5" role="alert">
<h3 class="alert-heading">Error to update data</h3>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p>Error to update data in MYSQL, try again</p>	
<hr>
<p class="mb-0">Redirecting to the Create Repository page, please wait...</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=index.php?p=NewRepository&Action=Update&id=$id'>"); 
}}
?>

<?php
// Update Repository
if($Action == "Delete"){
$id = $_GET['id'];
$Repository	= $_GET['Repository'];
$KeyUser = $_GET["KeyUser"];
$drop = ("DROP TABLE $Repository");
mysqli_query($mysqli, $drop);
$Delete   = ("DELETE FROM repositories WHERE CodRepository = '$Repository'");	
if(mysqli_query($mysqli, $Delete)){
exec("rm -f -r Users/$KeyUser/$Repository");
?>
<div class="alert alert-success text-center mt-5" role="alert">
<h3 class="alert-heading"><?php echo("Repository Deleted!");?></h3>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p><?php echo("The Repository ".$RepositoryName." has been deleted");?></p>
<hr>
<p class="mb-0">Redirecting to the repositories page, please wait ...</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=index.php'>"); ?>	
<?php								 
}else{
?>
<div class="alert alert-danger text-center mt-5" role="alert">
<h3 class="alert-heading">Error to delete data</h3>
<img src="img/logoBlack.png" alt="sGOat" height="250" class="rounded mx-auto d-block">
<p>Error to delete data in MYSQL, try again</p>	
<hr>
<p class="mb-0">Redirecting to the delete Repository page, please wait...</p>
</div>
<?php print("<META HTTP-EQUIV=REFRESH CONTENT= '5;URL=index.php?p=DeleteRepository&id=$id'>"); 
}}
?>