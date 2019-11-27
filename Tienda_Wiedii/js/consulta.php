<?php 
include("db.php");
include("conexion.php");


//////////////// VALORES INICIALES ///////////////////////

$tabla="";
$query="SELECT * FROM usuario ORDER BY id";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['usuario']))
{
	$q=$conexion->real_escape_string($_POST['usuario']);
	$query="SELECT * FROM usuario WHERE 
        id LIKE '%".$q."%' OR
		nombre LIKE '%".$q."%' OR
		cedula LIKE '%".$q."%' OR
        correo LIKE '%".$q."%'";
}        

$buscarUsuario=$conexion->query($query);
if ($buscarUsuario->num_rows > 0)
{
	$tabla.= 
	'<table class="table">
		<tr class="bg-primary">
			<td>ID usuario</td>
			<td>Nombre</td>
			<td>Cedula</td>
			<td>Correo</td>
		</tr>';

	while($filaUsuario= $buscarUsuario->fetch_assoc())
	{
		$tabla.=
		'<tr>
			<td>'.$filaUsuario['id'].'</td>
			<td>'.$filaUsuario['nombre'].'</td>
			<td>'.$filaUsuario['cedula'].'</td>
			<td>'.$filaUsuario['correo'].'</td>
		 </tr>
		';
	}

	$tabla.='</table>';
} else
	{
		$tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
	}


echo $tabla;
?>
