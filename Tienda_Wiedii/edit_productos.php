<?php
include("db.php");
include("conexion.php");


if  (isset($_GET['id'])) {
  $id= $_GET['id'];
  $query = "SELECT * FROM productos WHERE id = $id";
  $result = mysqli_query($conexion, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $codigo = $row['codigo'];
    $producto = $row['producto'];
    $precio = $row['precio'];
    $existencia = $row['existencia'];
  }
}

if (isset($_POST['guardar'])) {
  $id= $_GET['id'];
  $codigo= $_POST['codigo'];
  $producto= $_POST['producto'];
  $precio= $_POST['precio'];
  $existencia= $_POST['existencia'];

  $query = "UPDATE productos set codigo = '$codigo', producto = '$producto', precio = '$precio', 
  existencia = '$existencia' WHERE id = $id";
  mysqli_query($conexion, $query);
  $_SESSION['message'] = 'producto actualizado con exito';
  $_SESSION['message_type'] = 'warning';
  header('Location: producto.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_productos.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
          <input name="codigo" type="text" class="form-control" value="<?php echo $codigo; ?>" 
          placeholder="Actualizar Codigo"><br>
          <input name="producto" type="text" class="form-control" value="<?php echo $producto; ?>" 
          placeholder="Actualizar Producto"><br>
          <input name="precio" type="text" class="form-control" value="<?php echo $precio; ?>" 
          placeholder="Actualizar Precio"><br>
          <input name="existencia" type="text" class="form-control" value="<?php echo $existencia; ?>" 
          placeholder="Actualizar Existencia"><br>
        </div>
       
        <button class="btn btn-success" name="guardar">
          Guardar
</button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>
