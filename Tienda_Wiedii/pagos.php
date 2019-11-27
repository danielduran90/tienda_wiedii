<?php
session_start();
ob_start();
$_SESSION['total'];
$totall = $_SESSION['total'];
	$pago = $_POST['pago'];
if ($pago<$totall){
	$_SESSION['message'] = 'Valor ingresado es menor';
    $_SESSION['message_type'] = 'danger';
    header('Location: cartera.php');
}else{

$iduser = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM productos_vendidos WHERE productos_vendidos.id_usuario = $iduser;");
$resultado = $sentencia->execute();
$sentenciados = $base_de_datos->prepare("DELETE FROM abonos WHERE abonos.id_usuario = $iduser;");
$resultadodos = $sentenciados->execute();
if($resultado === TRUE){
	$_SESSION['message'] = 'Pago exitoso';
    $_SESSION['message_type'] = 'success';
    header('Location: cartera.php');
	exit;
}
else echo "Algo salió mal";
}
?>
