<?php
include_once "base_de_datos.php";
session_start(); 
ob_start();
$_SESSION['correouser'];
$_SESSION['nombreuser'];
$_SESSION['iduser'];
$_SESSION['totalg']=0;
$correo=($_SESSION['correouser']);
$usuario=($_SESSION['nombreuser']);
$iduser=($_SESSION['iduser']);

$query ="SELECT productos_vendidos.cantidad,
productos.producto, productos.precio, productos.codigo,
ventas.fecha 
FROM productos_vendidos 
INNER JOIN productos ON productos_vendidos.id_producto = productos.id
INNER JOIN ventas ON productos_vendidos.id_venta = ventas.id
WHERE productos_vendidos.id_usuario = $iduser 
ORDER BY fecha";
$consulta=$base_de_datos->query($query);

$body="Hola, $usuario.<br>Este es tu historial de compras:
<table style= text-align:center>
<thead>
  <tr>
    <th>Fecha</th>
    <th>Codigo</th>
    <th>Producto</th>
    <th>Precio</th>
    <th>Cantidad</th>
  </tr>
  </thead>
<tbody>";

while ($fila=$consulta->fetch(PDO::FETCH_ASSOC))
{
  $body .= '
  <tr>
  <td>'.$fila['fecha'].'</td>
  <td>'.$fila['codigo'].'</td>
  <td>'.$fila['producto'].'</td>
  <td>'.$fila['precio'].'</td>
  <td>'.$fila['cantidad'].'</td><br>
  </tr>
  ';
  $total += $fila['precio'];
}

$body.="</tbody>    
</table><br>TOTAL: $total<br><br>
Recuerda cancelar al finalizar la quincena...Muchas gracias.";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'pedrolopez970419@gmail.com';                     // SMTP username
    $mail->Password   = 'Werty9090';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('pedrolopez970419@gmail.com', 'Tienda Wiedii');
    $mail->addAddress($correo,);     


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Historial de Compras';
    $mail->Body    = $body;

    $mail->send();
    header("Location: index.php?status=1");
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
}
?>