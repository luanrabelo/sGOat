<?php
include("Connection.php");
$KeyUser 	= $_GET["KeyUser"];
$query 		= "SELECT * FROM users WHERE KeyUser = '$KeyUser'";
$result 	= $mysqli->query($query);
while ($row = $result->fetch_assoc()){	
$FirstName 		= $row["FirstName"];
$LastName 		= $row["LastName"];
$Institution	= $row["Institution"];
$Birthday		= $row["Birthday"];
$Email			= $row["Email"];	
}
?>
<style>
.Recover{
animation: pulseCat 0.7s infinite;	
}
@keyframes pulseCat {
10% {
box-shadow: 0 0 0 0 white;
}
80% {
box-shadow: 0 0 0 25px rgba(204, 169, 44, 0);
}	
100% {
box-shadow: 0 0 0 0 rgba(204, 169, 44, 0);
}
}	
</style>

<div class="modal fade" tabindex="-1" id="ResetPassModal">
<div class="modal-dialog modal-dialog-centered modal-xl">
<div class="modal-content">
<div class="modal-header bg-dark text-white h3"><div class="modal-title mx-auto">Resetting Password</div></div>
<div style="line-height: 3.5;" class="modal-body text-center mt-2 h3 text-black"><img src="img/logoBlack.png" alt="sGOat" height="200" class="rounded mx-auto d-block">Insert a new password in the <b>“New Password”</b> and <b>"Confirm New Password"</b> fields.</div>
<div class="modal-footer bg-dark"><button onClick="HideModalReset()" type="button" class="btn btn-success btn-lg"><i class="fas fa-thumbs-up mr-2"></i> I understood</button></div>
</div>
</div>
</div>

<img class="rounded mx-auto d-block mb-2" src="img/logo.png" alt="" width="150">
<div class="h3 text-center">sGOat</div>
<div class="h4 text-center"><b>S</b>oftware <b>G</b>ene <b>O</b>ntology <b>A</b>nnotation <b>T</b>ranscriptome</div>

<div class="text-left mx-auto mb-5 container">	
<form class="row g-3" action="Login.php?p=Functions&Action=UpdatePass&KeyUser=<?php echo($KeyUser);?>" method="POST">
<div class="text-center text-white mb-5 mt-5"><h2>Update Password</h2></div>
	
<div class="form-group col-md-6">	
<label class="text-white">First Name</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-user-circle"></i>
</div>	
</div>
<input name="FirstName" type="text" disabled="disabled" required="required" class="form-control mx-auto" id="FirstName" value="<?php echo($FirstName);?>" maxlength="50">	
</div>	
</div>	

<div class="form-group col-md-6">	
<label class="text-white">Last Name</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-user-circle"></i>
</div>	
</div>
<input name="LastName" type="text" disabled="disabled" required="required" class="form-control mx-auto" id="LastName" value="<?php echo($LastName);?>" maxlength="50">	
</div>	
</div>	

<div class="form-group col-md-6">	
<label class="text-white">Institution</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-university"></i>
</div>	
</div>
<input name="Institution" type="text" disabled="disabled" required="required" class="form-control mx-auto" id="Institution" value="<?php echo($Institution);?>" maxlength="50">	
</div>	
</div>	
	
<div class="form-group col-md-6">	
<label class="text-white">Birthday</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-birthday-cake"></i>
</div>	
</div>
<input name="Birthday" type="date" disabled="disabled" required="required" class="form-control mx-auto" value="<?php echo($Birthday);?>" id="Birthday">
</div>	
</div>

<div class="form-group col-md-12">	
<label class="text-white">Email address</label>	
<div class="input-group mb-4">
<div class="input-group-prepend">	
<div class="input-group-text"><i class="fas fa-2x fa-at"></i>
</div>	
</div>
<input name="Email" type="Email" disabled="disabled" required="required" class="form-control mx-auto" id="Email" value="<?php echo($Email);?>" maxlength="50">	
</div>	
</div>
	
	
<div id="NewPass" class="form-group col-md-6 Recover">	
<label class="text-white">New Password</label>	
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
<div id="NewPassCon" class="form-group col-md-6 Recover">	
<label class="text-white">Confirm New Password</label>	
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

	
<button id="UpdatePassword" type="submit" class="btn btn-primary btn-lg btn-block">Update Password</button>
<div>
</div>	
</form>
</div>

<script>
function HideModalReset() {
$('#ResetPassModal').modal('hide');
}	
</script>

<script>
$(document).ready(function () {  
$('#UpdatePassword').addClass('disabled');
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
			$('#Password').removeClass('bg-danger');
			$('#Password').addClass('bg-success');
			$('#ConfirmPassword').removeClass('bg-danger');
			$('#ConfirmPassword').addClass('bg-success');
			$('#UpdatePassword').removeClass('disabled');
			$('#UpdatePassword').removeClass('btn-danger');
			$('#UpdatePassword').removeClass('btn-primary');
			$('#UpdatePassword').addClass('btn-success');
			$('#NewPass').removeClass('Recover');
			$('#NewPassCon').removeClass('Recover');
			

} else {
			$('#Password').addClass('bg-danger');
			$('#ConfirmPassword').addClass('bg-danger');
			$('#UpdatePassword').removeClass('btn-primary');
			$('#UpdatePassword').addClass('btn-danger');
			$('#UpdatePassword').addClass('disabled');
			alert("Password do not match!");
		}
} else if (ConfirmPassword.length > Password.length){
	$('#Password').addClass('bg-danger');
	$('#ConfirmPassword').addClass('bg-danger');
	$('#UpdatePassword').removeClass('btn-primary');
	$('#UpdatePassword').addClass('btn-danger');
	$('#UpdatePassword').addClass('disabled');
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

<script>
$(document).ready(function(){
	
setTimeout(function(){
$('#ResetPassModal').modal('show');
}, 2000);
	
$("#OK").click(function(){
$('html, body').animate({ scrollTop: 500  }, 1);
});	
});
</script>
<script>
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
</script>