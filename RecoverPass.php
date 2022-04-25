<div id="ErrorLogin" class="alert alert-danger alert-dismissible fade w-75 mx-auto text-center show" role="alert">
<img src="img/logoBlack.png" alt="sGOat" height="200" class="rounded mx-auto d-block">
<div class="h4 text-black">An error occurred during the recovery of your login information, please check your details and try again.</div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


<div class="modal fade" tabindex="-1" id="FormPassword">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-dark">
<h5 class="modal-title mx-auto">Querying Database</h5>
</div>
<div class="modal-body text-center">
<img src="img/logoBlack.png" alt="sGOat" height="200" class="rounded mx-auto d-block" >
<p class="text-center text-black mt-5">Please wait....</p>			
</div>
</div>
</div>
</div>


<div class="modal fade" tabindex="-1" id="ResetPassModal">
<div class="modal-dialog modal-dialog-centered modal-xl">
<div class="modal-content">
<div class="modal-header bg-dark text-white h3"><div class="modal-title mx-auto">Resetting Password</div></div>
<div style="line-height: 3.5;" class="modal-body text-center mt-1 h4 text-black">
<img src="img/logoBlack.png" alt="sGOat" height="200" class="rounded mx-auto d-block" >
<div>To reset your password, we need to validate your personal information, please inform your <b>First Name</b>, <b>Last Name</b>, <b>Institution</b>, <b>Birthday</b> and the <b>Email address</b> registered at sGOat. When this information has been validated, a new field (New Password) will appear and you can insert your new password.</div>
</div>
<div class="modal-footer bg-dark"><button onClick="HideModalReset()" type="button" class="btn btn-success btn-lg"><i class="fas fa-thumbs-up mr-2"></i> I understood</button></div>
</div>
</div>
</div>

<img class="rounded mx-auto d-block mb-2" src="img/logo.png" alt="" width="150">
<div class="h3 text-center">sGOat</div>
<div class="h4 text-center"><b>S</b>oftware <b>G</b>ene <b>O</b>ntology <b>A</b>nnotation <b>T</b>ranscriptome</div>



<div class="text-left mx-auto mb-3 container">	
<div class="text-center text-white mb-2 mt-5 mb-5"><h2>Reset Password</h2></div>
<form class="row g-3" method="POST" id="Recover">	
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
<button type="submit" class="btn btn-primary btn-lg d-grid gap-2 col-6 mx-auto mt-5 mb-2">Reset Password</button>
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
$(document).ready(function(){
setTimeout(function(){
$('#ResetPassModal').modal('show');
}, 2000);	
	
$('#ErrorLogin').hide();
$('#Recover').submit(function(){
$('#FormPassword').modal('show'); 
	
// Variáveis Login
var FirstName 	=$('#FirstName').val();
var LastName 	=$('#LastName').val();	
var Birthday	=$('#Birthday').val();	
var Email 		=$('#Email').val();	
var Institution	=$('#Institution').val();	

$.ajax({
url:  "Recover.php",
type: "POST",
data: {"FirstName" : FirstName, "LastName" : LastName, "Institution" : Institution, "Birthday" : Birthday, "Email" : Email},
success: function (result) {
console.log(result);

if(result == 0){
$('#FormPassword').modal('hide'); 	
$('#ErrorLogin').show();
} else {
data = $.parseJSON(result);	
location.href = 'Login.php?p=NewPassword&KeyUser='+data.KeyUser;
}}});
return false;
})})
</script>