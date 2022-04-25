<?php
include("Connection.php");
$Users = "CREATE TABLE IF NOT EXISTS Users(
   idUser INT NOT NULL AUTO_INCREMENT,
   FirstName VARCHAR(50) NOT NULL,
   LastName VARCHAR(50) NOT NULL,
   Institution VARCHAR(50) NOT NULL,
   Birthday VARCHAR(10) NOT NULL,
   Email VARCHAR(50) NOT NULL,
   Password VARCHAR(255) NOT NULL,
   DateCreation DATE,
   KeyUser VARCHAR(50) NOT NULL,
   PRIMARY KEY ( idUser )
);";
mysqli_query($mysqli, $Users) or die (mysql_error());
?>

<img class="rounded mx-auto d-block mb-2 mt-4 align-middle" src="img/logo.png" alt="" width="150">
<div class="h3 text-center">GOat</div>
<div class="h4 text-center"><b>S</b>oftware <b>G</b>ene <b>O</b>ntology <b>A</b>nnotation <b>T</b>ranscriptome</div>
<div class="text-left mx-auto mb-3 container">	
<div class="text-center text-white mb-2 mt-5 mb-5"><h2>New sGOat User</h2></div>
<form class="row g-3" action="Login.php?p=Functions&Action=CDSNewUser" method="POST" id="CDSNewUser">	
<div class="form-group col-md-6">	
<label class="text-white">First Name</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-user-circle"></i>
</div>	
</div>
<input name="FirstName" type="text" required="required" class="form-control mx-auto" id="FirstName" maxlength="50">	
</div>	
</div>	
	
<div class="form-group col-md-6">	
<label class="text-white">Last Name</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-user-circle"></i>
</div>	
</div>
<input name="LastName" type="text" required="required" class="form-control mx-auto" id="LastName" maxlength="50">	
</div>	
</div>	
	
<div class="form-group col-md-6">	
<label class="text-white">Institution</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-university"></i>
</div>	
</div>
<input name="Institution" type="text" required="required" class="form-control mx-auto" id="Institution" maxlength="50">	
</div>	
</div>	
	
<div class="form-group col-md-6">	
<label class="text-white">Birthday</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-birthday-cake"></i>
</div>	
</div>
<input name="Birthday" type="date" required="required" class="form-control mx-auto" id="Birthday">
</div>	
</div>
	
<div class="form-group col-md-12">	
<label class="text-white">Email address</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-at"></i>
</div>	
</div>
<input name="Email" type="Email" required="required" class="form-control mx-auto" id="Email" maxlength="50">	
</div>	
</div>

<div class="form-group col-md-6">	
<label class="text-white">Password</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-key"></i>
</div>	
</div>
<input name="Password" type="Password" required="required" class="form-control mx-auto" id="Password">
<div class="input-group-append">
<div class="input-group-text">	
<i id="Eye" class="fas fa-2x fa-eye" onClick="PassShow()"></i>
</div>	
</div>
<div id="strengthMessage"></div>	
</div>
</div>	

<div class="form-group col-md-6">	
<label class="text-white">Confirm Password</label>	
<div class="input-group mb-3">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-key"></i>
</div>	
</div>
<input name="ConfirmPassword" type="Password" required="required" class="form-control mx-auto" id="ConfirmPassword">
<div class="input-group-append">
<div class="input-group-text">	
<i id="Eye2" class="fas fa-2x fa-eye" onClick="PassShow2()"></i>
</div>	
</div>
</div>
</div>
<button type="submit" class="btn btn-primary btn-lg d-grid gap-2 col-6 mx-auto mt-5 mb-2" id="SubmitFormUser">Sign Up sGOat</button>
<div>
</div>	
</form>
</div>
<script>
$(document).ready(function () {  
$('#SubmitFormUser').addClass('disabled');
$('#Password').keyup(function() {  
$('#strengthMessage').html(checkStrength($('#Password').val()));
});

$('#ConfirmPassword').keyup(function(){
ConfirmPassword(); 
});
	
function ConfirmPassword(){
var Password = document.getElementById('Password').value;
var ConfirmPassword = document.getElementById('ConfirmPassword').value;
if(ConfirmPassword.length == Password.length){
if($('#Password').val() == $('#ConfirmPassword').val()){
console.log("Mudou");
			$('#Password').removeClass('bg-danger');
			$('#Password').addClass('bg-success');
			$('#ConfirmPassword').removeClass('bg-danger');
			$('#ConfirmPassword').addClass('bg-success');
			$('#SubmitFormUser').removeClass('disabled');
			$('#SubmitFormUser').removeClass('btn-danger');
			$('#SubmitFormUser').removeClass('btn-primary');
			$('#SubmitFormUser').addClass('btn-success');	

} else {
			$('#Password').addClass('bg-danger');
			$('#ConfirmPassword').addClass('bg-danger');
			$('#SubmitFormUser').removeClass('btn-primary');
			$('#SubmitFormUser').addClass('btn-danger');
			$('#SubmitFormUser').addClass('disabled');
			alert("Password do not match!");
		}
} else if (ConfirmPassword.length > Password.length){
	$('#Password').addClass('bg-danger');
	$('#ConfirmPassword').addClass('bg-danger');
	$('#SubmitFormUser').removeClass('btn-primary');
	$('#SubmitFormUser').addClass('btn-danger');
	$('#SubmitFormUser').addClass('disabled');
	alert("Password do not match!");
}

}

function checkStrength(password){  
var strength = 0  
if (password.length < 6) {  
$('#strengthMessage').removeClass()  
$('#strengthMessage').addClass('Short') 
return '<div class="mt-2">Too short<div>'  
}  
if (password.length > 7) strength += 1  
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1  
if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1  
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1  
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1  
if (strength < 2) {  
$('#strengthMessage').removeClass()  
$('#strengthMessage').addClass('Weak')  
return '<div class="mt-2">Weak<div>'  
} else if (strength == 2) {  
$('#strengthMessage').removeClass()  
$('#strengthMessage').addClass('Good')  
return '<div class="mt-2">Good<div>'  
} else {  
$('#strengthMessage').removeClass()  
$('#strengthMessage').addClass('Strong')  
return '<div class="mt-2">Strong<div>'  
}}});

function PassShow() {
var x = document.getElementById("Password");
if (x.type === "password") {
x.type = "text";
$("#Eye").removeClass("fa-eye");
$("#Eye").addClass("fa-eye-slash");
} else {
x.type = "password";
$("#Eye").removeClass("fa-eye-slash");
$("#Eye").addClass("fa-eye");
}
} 
function PassShow2() {
var x = document.getElementById("ConfirmPassword");
if (x.type === "password") {
x.type = "text";
$("#Eye2").removeClass("fa-eye");
$("#Eye2").addClass("fa-eye-slash");
} else {
x.type = "password";
$("#Eye2").removeClass("fa-eye-slash");
$("#Eye2").addClass("fa-eye");
}
} 
</script>