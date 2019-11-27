<?php

include_once "base_de_datos.php";

session_start();
ob_start();
$_SESSION['totalg'];
$total = $_SESSION['totalg'];
$huella= $_POST["huella"];

if ($total < 1){
	header("Location: ./index.php?status=2");
	exit;
}

$conne = $base_de_datos->prepare("SELECT * FROM usuario WHERE  huella = '$huella'");
$conne->execute();
$result= $conne->fetch(PDO::FETCH_OBJ);
if ($result){


$user= ($result->id);
$correouser=($result->correo);
$nombreuser=($result->nombre);
$_SESSION['correouser'] = $correouser;
$_SESSION['nombreuser'] = $nombreuser;
$_SESSION['iduser'] = $user;

	$ahora = date("Y-m-d H:i:s");


$sentencia = $base_de_datos->prepare("INSERT INTO ventas(fecha, total) VALUES (?, ?);");
$sentencia->execute([$ahora, $total]);

$sentencia = $base_de_datos->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;
$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO productos_vendidos(id_producto, id_venta, cantidad, id_usuario) 
VALUES (?, ?, ?, ?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE productos SET existencia = existencia - ? WHERE id = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->total;
	$sentencia->execute([$producto->id, $idVenta, $producto->cantidad, $user]);
	$sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
}


$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
$total=0;
header("Location: ./enviarmail.php");




}else{
	$_SESSION['message'] = 'Huella no reconocida.';
    $_SESSION['message_type'] = 'danger';
    header("location: huella.php"); 
}

?>