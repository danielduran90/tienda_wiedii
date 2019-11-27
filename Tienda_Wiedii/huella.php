
<?php

session_start();
ob_start();
$_SESSION['totalg'];

$total = $_SESSION['totalg'];
if ($total == 0){
	header("Location: ./index.php?status=5");
	exit;
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <LINK REL=StyleSheet HREF="css/style.css" TYPE="text/css" MEDIA=screen>
    <LINK REL=StyleSheet HREF="css/bootstrap.min.css" TYPE="text/css" MEDIA=screen>
    <title>Tienda Wiedii</title>
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
	<a href= "devoluciones.php" class="btn btn-outline-light">Devoluciones</a>
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
      <?php unset($_SESSION['message']); } ?>
      
<br>
<br>
<br>  
<h2>INGRESE LA HUELLA POR FAVOR...</h2>

<form action="terminarVenta.php" class="formu" method="post">
				<input autocomplete="off" name="huella" id="huella" autofocus onblur="blurFunction()" required>
				<input name="submit" type="submit" value="Ingresar">
</form>
<script>
 function blurFunction() {
 document.getElementById("huella").focus();
  }
</script>
<?php include('includes/footer.php'); ?>