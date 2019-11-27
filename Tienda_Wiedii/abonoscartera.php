<?php
include_once "base_de_datos.php";
session_start();
ob_start();
$iduser = $_GET["id"];
$abono=$_POST['abono'];
$sentencia = $base_de_datos->prepare ("INSERT INTO abonos(id_usuario, abono) VALUES ($iduser, $abono)");
$sentencia->execute();
header("Location: ./enviarmailabono.php");
?>