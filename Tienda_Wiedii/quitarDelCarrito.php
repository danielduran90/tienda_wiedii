<?php
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];
$_SESSION['totalg']=0;
session_start();
array_splice($_SESSION["carrito"], $indice, 1);
header("Location: index.php?status=3");
?>