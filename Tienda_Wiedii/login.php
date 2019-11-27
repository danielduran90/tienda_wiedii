<?php
include('verify.php'); 

if(isset($_SESSION['login_user_sys'])){
header("location: cartera.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>login</title>

<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<LINK REL=StyleSheet HREF="css/style.css" TYPE="text/css" MEDIA=screen>
<LINK REL=StyleSheet HREF="css/bootstrap.min.css" TYPE="text/css" MEDIA=screen>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a href="index.php" class="logow"><img src="img/mainlogo.svg" width="130px" height="68px"></a> 
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
     
    </ul>
    <div>
      <a href= "login.php" class="btn btn-outline-light">Ingresar</a>
    </div>
  </div>
</nav>
   <!-- MESSAGES -->

   <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>

<br>
<div class="header agile">
	<div class="wrap">
		<div class="login-main wthree">
			<div class="login">
			<h2>Iniciar sesión</h2>
			<form action="verify.php" class="formu" method="post">
				<input type="text" placeholder="Correo" required="" name="username" autofocus required>
				<input type="password" placeholder="Contraseña" name="password" autofocus required>
				<input name="submit" type="submit" value="Ingresar">
			</form>
			<div class="clear"> </div>
				<span><?php echo $error; ?></span>
			</div>
			
			
		</div>
	</div>
</div>

<?php include('includes/footer.php'); ?>
</body>
</html>