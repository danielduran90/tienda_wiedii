<?php

include("db.php");
include("conexion.php");

if (isset($_POST['save_producto'])) {
    $codigo = $_POST['codigo'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $existencia = $_POST['existencia'];
    
    $query = "INSERT INTO productos(codigo, producto, precio, existencia) VALUES 
    ('$codigo', '$producto', '$precio', '$existencia')";
    $result = mysqli_query($conexion, $query);
    if(!$result) {
      die("Query Failed.");
    }
  
    $_SESSION['message'] = 'Producto guardado con exito';
    $_SESSION['message_type'] = 'success';
    header('Location: producto.php');
}

?>
