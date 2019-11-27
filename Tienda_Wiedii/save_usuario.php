<?php

include("db.php");
include("conexion.php");

if (isset($_POST['save_usuario'])) {
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $huella = $_POST['huella'];
    
    $query = "INSERT INTO usuario(cedula, nombre, telefono, correo, huella) VALUES 
    ('$cedula', '$nombre', '$telefono', '$correo', '$huella')";
    $result = mysqli_query($conexion, $query);
    if(!$result) {
      die("Query Failed.");
    }
  
    $_SESSION['message'] = 'Usuario guardado con exito';
    $_SESSION['message_type'] = 'success';
    header('Location: usuario.php');
}

?>
