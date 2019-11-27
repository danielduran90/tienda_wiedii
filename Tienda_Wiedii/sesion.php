<?php

include("db.php");
include("conexion.php");

session_start();

$user_check=$_SESSION['login_user_sys'];

$ses_sql=mysqli_query($con, "select email from login where email='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['email'];
if(!isset($login_session)){
mysqli_close($con); 
header('Location: login.php'); 
}
?>