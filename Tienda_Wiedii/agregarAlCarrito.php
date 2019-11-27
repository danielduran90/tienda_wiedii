<?php
if (!isset($_POST["codigo"])) {
    return;
}
$codigo = $_POST["codigo"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE codigo = ? LIMIT 1");
$sentencia->execute([$codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);

if (!$producto) {
    header("Location: index.php?status=4");
    exit;
}


session_start();
$indice = false;

if($indice === FALSE){
    $producto->cantidad = 1;
    $producto->total = $producto->precio;
    array_push($_SESSION["carrito"], $producto);
}else{
    $_SESSION["carrito"][$indice]->cantidad++;
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"]
    [$indice]->cantidad * $_SESSION["carrito"][$indice]->precio;
}
header("Location: index.php");
?>