<?php 
include_once "base_de_datos.php";
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

<?php 
session_start(); 
ob_start();
$_SESSION['userid'];
?>
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
            <th>Usuario</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
         $iduser= ($_SESSION['userid']);
          
          $query ="SELECT productos_vendidos.cantidad,productos_vendidos.id,
                          productos.producto, productos.precio, productos.codigo,
                          ventas.fecha, 
                          usuario.nombre
                   FROM productos_vendidos 
                   INNER JOIN productos ON productos_vendidos.id_producto = productos.id
                   INNER JOIN ventas ON productos_vendidos.id_venta = ventas.id
                   INNER JOIN usuario ON productos_vendidos.id_usuario = usuario.id
                   WHERE usuario.huella = $iduser 
                   ORDER BY fecha";
                   $consulta=$base_de_datos->query($query);
                   while ($fila=$consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                    
                       
                     <tr>
                     <td><?php echo $fila['fecha']; ?></td>
                     <td><?php echo $fila['codigo']; ?></td>
                     <td><?php echo $fila['producto']; ?></td>
                     <td><?php echo $fila['precio']; ?></td>
                     <td><?php echo $fila['cantidad']; ?></td>
                     <td><?php echo $fila['nombre']; ?></td>
                     <td>
                     <a href="devolucionesproducto.php?id=<?php echo $fila['id']?>" class="btn btn-danger">Devolver</a>
                     </td>
                     </tr>
                       
                       <?php } ?>    
           
                  
        </tbody>    
      </table>
    </div>
       <?php include('includes/footer.php'); ?>
       </body>
       </html>