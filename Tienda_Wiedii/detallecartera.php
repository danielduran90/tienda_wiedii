<?php
session_start();
ob_start();
$subtotal = 0;
$abono=0;
$total=0;
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
      <a href= "Cartera.php" class="btn btn-outline-light">Cartera</a>
      <a href= "producto.php" class="btn btn-outline-light">Registro de Productos</a>
      <a href= "usuario.php" class="btn btn-outline-light">Registro de Usuarios</a>
      <a href= "logout.php" class="btn btn-outline-light">Cerrar Sesion</a>
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

    <a href="./cartera.php" class="btn btn-secondary" style="margin: 1rem">Atrás</a>
  
    			<!-- Button modal pagos-->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" 
style="margin: 1rem; float:left; ">Realizar Pago
</button>
    			<!-- Button modal abonos-->
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter2" 
style="margin: 1rem; float:left; ">Realizar Abono
</button>

    

<?php
include_once "base_de_datos.php";

?>
<br>
<br>
<div class="col-md-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $iduser= $_GET['id'];

          $conne = $base_de_datos->prepare("SELECT SUM(abono) abono FROM abonos WHERE  id_usuario = '$iduser'");
          $conne->execute();
          $result= $conne->fetch(PDO::FETCH_ASSOC);
          $abono = ($result['abono']);
          $_SESSION['abono'] = $abono;
          $query ="SELECT productos_vendidos.cantidad,
                          productos.producto, productos.precio, productos.codigo,
                          ventas.fecha, 
                          usuario.correo, usuario.nombre, usuario.id
                   FROM productos_vendidos 
                   INNER JOIN productos ON productos_vendidos.id_producto = productos.id
                   INNER JOIN ventas ON productos_vendidos.id_venta = ventas.id
                   INNER JOIN usuario ON productos_vendidos.id_usuario = usuario.id
                   WHERE productos_vendidos.id_usuario = $iduser 
                   ORDER BY fecha";
                   
                   
                   $consulta=$base_de_datos->query($query);
                   while ($fila=$consulta->fetch(PDO::FETCH_ASSOC))
                     {
                       echo'
                       <tr>
                       <td>'.$fila['fecha'].'</td>
                       <td>'.$fila['codigo'].'</td>
                       <td>'.$fila['producto'].'</td>
                       <td>'.$fila['precio'].'</td>
                       <td>'.$fila['cantidad'].'</td>
                       </tr>
                       ';
                       $subtotal += $fila['precio'];
                       $correouser = $fila['correo'];
                       $usuarioname = $fila['nombre'];
                       $usuarioid = $fila['id'];
                       $total = ($subtotal-$abono);
                       $_SESSION['total'] = $total;
                       $_SESSION['correoc'] = $correouser;
                       $_SESSION['usuarioc'] = $usuarioname; 
                       $_SESSION['idc'] = $usuarioid; 
                     }
                   
                   ?>
        </tbody>    
      </table>
    </div>

    <!-- Modal pagos -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sistema de Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <form method="post" style="text-align:center" action="pagos.php?id=<?php echo $iduser?>">
			<input autocomplete="off" class="form-control" name="pago" 
			required type="text" id="pago" placeholder="Ingresar Valor" required><br>
     <input type="submit" name="submit" class="btn btn-success" value="Registrar Pago">
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal abonos-->
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sistema de Abonos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form method="post" style="text-align:center" action="abonoscartera.php?id=<?php echo $iduser?>">
			<input autocomplete="off" class="form-control" name="abono" 
			required type="text" id="abono" placeholder="Ingresar Valor" required><br>
      <input type="submit" name="submits" class="btn btn-success" value="Registrar Abono">
        </form>
      </div>
    </div>
  </div>
</div>
<h3 style="margin: 1rem 1rem 0">Subtotal: $<?php echo $subtotal; ?></h3>
<h3 style="margin: 1rem 1rem 0">Abonó: $ <?php echo $abono; ?></h3>
<h3 style="margin: 1rem 1rem 0">Total: $ <?php echo $total; ?></h3>
 <?php include('includes/footer.php'); ?>
 