<?php
session_start();
ob_start();
include('verify.php'); 
include("db.php");
include("conexion.php");

if(!isset($_SESSION['login_user_sys'])){
header("location: login.php");
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, 
    maximum-scale=1.0, minimum-scale=1.0">
    <LINK REL=StyleSheet HREF="css/style.css">
    <LINK REL=StyleSheet HREF="css/bootstrap-grid.min.css" TYPE="text/css" MEDIA=screen>
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
      <a href= "cartera.php" class="btn btn-outline-light">Cartera</a>
      <a href= "producto.php" class="btn btn-outline-light">Registro de Productos</a>
      <a href= "usuario.php" class="btn btn-outline-light">Registro de Usuarios</a>
      <a href= "logout.php" class="btn btn-outline-light">Cerrar Sesion</a>
    </div>
  </div>
</nav>
<br>
<br>
<br>
  <!-- MESSAGES -->

  <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset($_SESSION['message']); } ?>
<div class="col-md-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        
        

          <?php
          $query = "SELECT * FROM usuario";
          $result_usuario = mysqli_query($conexion, $query);    

          while($row = mysqli_fetch_assoc($result_usuario)) { ?>
          <tr>
            
            <td><?php echo $row['cedula']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['correo']; ?></td>
            <td>
              <a href="detallecartera.php?id=<?php echo $row['id']?>" class="btn btn-secondary">Detalles</a>
            </td>
          </tr>
          
          <?php } ?>
        </tbody>
      </table>
    </div>

    <?php include('includes/footer.php'); ?>