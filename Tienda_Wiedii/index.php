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
	<a href= "devolucionesingreso.php" class="btn btn-outline-light">Devoluciones</a>
    <a href= "login.php" class="btn btn-outline-light">Ingresar</a>
    </div>
  </div>
</nav>
  
<br>
	
<!-----------------table------------------>
<?php 
include_once "base_de_datos.php";
session_start();
ob_start();

if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>
	<div class="col-xs-12">

		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Venta realizada correctamente
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
						</div> 
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
              <strong>Venta cancelada</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
              <strong>Ok</strong> Producto quitado de la lista
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-warning">
              <strong>Error:</strong> El producto que buscas no existe
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
              <strong>Error: </strong>No ha ingresado productos
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
						</div>
					<?php
				}else if($_GET["status"] === "6"){
					?>
					<div class="alert alert-danger">
			  <strong>Error: </strong>Huella no Reconocida
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
					</div>
					<?php	
				}else{
					?>
					<div class="alert alert-danger">
              <strong>Error:</strong> Algo salió mal mientras se realizaba la venta
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
						</div>
					<?php 
        }
        
			}
		?>

<div class="col-md-12">
<form method="post" action="agregarAlCarrito.php">
			<input autocomplete="off" class="form-control" name="codigo" autofocus onblur="blurFunction()"
			required type="text" id="codigo" placeholder="Ingresar el código">
		</form>
		       <script>
                        function blurFunction() {
                            document.getElementById("codigo").focus();
                        }
                    </script>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Código</th>
					<th>Producto</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
						$granTotal += $producto->total;
						$_SESSION['totalg'] = $granTotal;
					?>
				<tr>

					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->producto ?></td>
					<td><?php echo $producto->precio?></td>
					<td><?php echo $producto->cantidad ?></td>
					<td style="text-align: center"><a class="btn btn-danger" href="<?php 
					echo "quitarDelCarrito.php?indice=" . $indice?>">
					Quitar</a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

    </div>
  </div>

  <h3 style="margin: 1rem 1rem 0">Total: <?php echo $granTotal; ?></h3>
		<form action="./huella.php" method="POST">
			<input name="total" type="hidden" value="<?php echo $granTotal;?>">

			<a href="./huella.php" class="btn btn-success" style="margin: 1rem">Terminar venta</a>
			<a href="./cancelarVenta.php" class="btn btn-danger" style="margin: 1rem">Cancelar venta</a>
		</form>
<?php include('includes/footer.php'); ?>
</body>
</html>