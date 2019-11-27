<?php
include_once "base_de_datos.php";

session_start(); 
ob_start();

$huella= $_POST["huella"];
$_SESSION['userid'] = $huella;

$conne = $base_de_datos->prepare("SELECT * FROM usuario WHERE  huella = '$huella'");
$conne->execute();
$result= $conne->fetch(PDO::FETCH_OBJ);
$iduser= ($result->id);
$_SESSION['usuar'] = $iduser;

if ($result){

    header("location: devoluciones.php"); 

}else{
    $_SESSION['message'] = 'Huella no reconocida.';
    $_SESSION['message_type'] = 'danger';
    header("location: devolucionesingreso.php"); 
}
include('includes/footer.php'); 


?>