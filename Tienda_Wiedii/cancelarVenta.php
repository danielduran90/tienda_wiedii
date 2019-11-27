<?php

session_start();
ob_start();

unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
$_SESSION['totalg']=0;

header("Location: ./index.php?status=2");
?>