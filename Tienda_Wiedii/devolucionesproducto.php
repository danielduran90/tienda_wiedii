<?php
include_once "base_de_datos.php";
session_start(); 
ob_start();
$id= $_GET['id'];

$sentenciados = $base_de_datos->prepare("DELETE FROM productos_vendidos WHERE id = $id;");
$resultados = $sentenciados->execute();
if($resultados === TRUE){
	header("Location: ./devoluciones.php");
	exit;
}
else echo "Algo salió mal";
?>
