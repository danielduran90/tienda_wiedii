<?php
session_start(); 
$error=''; 
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "El correo electrónico o la contraseña es inválida.";
}
else
{

$username=$_POST['username'];
$password=$_POST['password'];


include("db.php");
include("conexion.php");


$username    = mysqli_real_escape_string($conexion,(strip_tags($username,ENT_QUOTES)));
$password =  sha1($password);
$sql = "SELECT email, password FROM administrador WHERE email = '" . $username . "' and password='".$password."' ";
$query=mysqli_query($conexion,$sql);
$counter=mysqli_num_rows($query);
if ($counter==1){
		$_SESSION['login_user_sys']=$username; 
		header("location: cartera.php"); 
	
	
} else {
$_SESSION['message'] = 'El correo electrónico ó la contraseña es inválida.';
$_SESSION['message_type'] = 'danger';
header('Location: login.php');
}
}
}
?>