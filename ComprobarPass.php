<?php 
require_once("conexion.php");

$id = -1;
$pass = -1;

if(isset($_GET["id"]) && isset($_GET["pass"])) {

	$id = $_GET["id"];
	$pass = md5($_GET["pass"]);
}

$query1 = "SELECT contrasena FROM usuario WHERE id= $id";
$result1 = mysqli_query($conexion, $query1); ?>

<div id="msj_Wpass">
<?php while ($fila = mysqli_fetch_assoc($result1)){
  if($fila["contrasena"] != $pass){ echo "Contrasena incorrecta"; } }?>
</div>