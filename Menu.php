<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
<a class="navbar-brand" href="index.php"><img src="img/logoBlack.png" alt="sGOat" height="75" class="rounded mx-auto d-block"></a>
	
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
		  
<li class="nav-item"><a class="nav-link active" href="index.php?p=Home"><i class="fas fa-3x fa-home mr-3"></i> Home</a></li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-3x fa-cogs mr-3"></i> Options</a>
<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
<li><a class="dropdown-item" href="index.php?p=NewRepository&Action=CDS">Create a new Repository</a></li>
</ul>
</li>
<li class="nav-item mr-3 ml-3"><a class="nav-link active" href="index.php?p=Manual"><i class="fas fa-3x fa-file-pdf mr-3"></i> Manual</a></li>
<li class="nav-item mr-3 ml-3"><a class="nav-link active" href="index.php?p=Logout&Token=<?php echo(md5(session_id()));?>"><i class="fas fa-3x fa-sign-out-alt mr-3"></i> Logout</a></li>
				  
		  
		  

      </ul>
    </div>
  </div>
</nav>