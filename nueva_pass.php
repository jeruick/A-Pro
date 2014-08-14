<?php
require_once("conexion.php");

$texto1 = -1;
$texto2 = -1;

if(isset($_GET["texto1"]) && isset($_GET["texto2"])){

	$texto1 = $_GET["texto1"];
	$texto2 = $_GET["texto2"];
} ?>

<div>
<?php  if($texto1 != $texto2){
	echo "Las contraseñas no coinciden";
}
else{ echo "Correcto"; }?>
</div>
