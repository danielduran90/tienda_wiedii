<?php
include("db.php");
include("conexion.php");


if  (isset($_GET['id'])) {
  $id= $_GET['id'];
  $query = "SELECT * FROM usuario WHERE id = $id";
  $result = mysqli_query($conexion, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $cedula = $row['cedula'];
    $nombre = $row['nombre'];
    $telefono = $row['telefono'];
    $correo = $row['correo'];
    $huella = $row['huella'];
  }
}

if (isset($_POST['guardar'])) {
  $id= $_GET['id'];
  $cedula= $_POST['cedula'];
  $nombre= $_POST['nombre'];
  $telefono= $_POST['telefono'];
  $correo= $_POST['correo'];
  $huella= $_POST['huella']; 

  $query = "UPDATE usuario set nombre = '$nombre', cedula = '$cedula', telefono = '$telefono', 
  correo = '$correo', huella = '$huella' WHERE id = $id";
  mysqli_query($conexion, $query);
  $_SESSION['message'] = 'usuario actualizado con exito';
  $_SESSION['message_type'] = 'warning';
  header('Location: usuario.php');
}

?>

<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit_usuario.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
          <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" 
          placeholder="Actualizar Nombre"><br>
          <input name="cedula" type="text" class="form-control" value="<?php echo $cedula; ?>" 
          placeholder="Actualizar Cedula"><br>
          <input name="telefono" type="text" class="form-control" value="<?php echo $telefono; ?>" 
          placeholder="Actualizar Telefono"><br>
          <input name="correo" type="text" class="form-control" value="<?php echo $correo; ?>" 
          placeholder="Actualizar Correo"><br>
          <input name="huella" type="text" class="form-control" value="<?php echo $huella; ?>" 
          placeholder="Actualizar Huella">
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
