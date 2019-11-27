<?php
include('verify.php'); 

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
<h2>REGISTRO DE PRODUCTOS</h2>
<?php
include("db.php");
include("conexion.php");

 ?>


<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset($_SESSION['message']); } ?>

      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="save_productos.php" method="POST">
          <div class="form-group">
            <input type="text" name="codigo" class="form-control" placeholder="Codigo" autofocus required><br>
            <input type="text" name="producto" class="form-control" placeholder="Producto" autofocus required><br>
            <input type="text" name="precio" class="form-control" placeholder="Precio" autofocus required><br>
            <input type="text" name="existencia" class="form-control" placeholder="existencia" autofocus required>
          </div>
          <input type="submit" name="save_producto" class="btn btn-success btn-block" value="Ingresar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Existencia</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM productos";
          $result_producto = mysqli_query($conexion, $query);    

          while($row = mysqli_fetch_assoc($result_producto)) { ?>
          <tr>
            <td><?php echo $row['codigo']; ?></td>
            <td><?php echo $row['producto']; ?></td>
            <td><?php echo $row['precio']; ?></td>
            <td><?php echo $row['existencia']; ?></td>
            <td>
              <a href="edit_productos.php?id=<?php echo $row['id']?>" class="btn btn-secondary">Editar</a>
              <a href="delete_producto.php?id=<?php echo $row['id']?>" class="btn btn-danger">Eliminar</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>


</body>
</html>