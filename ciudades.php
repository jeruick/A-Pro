<?php
require_once("conexion.php");
$id_pais = $_GET["q"];
$consultaCiudad = "SELECT * FROM ciudad WHERE id_pais = $id_pais;";
$resultadoCiudad = mysqli_query($conexion, $consultaCiudad);
while ($registroCiudad = mysqli_fetch_array($resultadoCiudad)){
	echo "<option value='".$registroCiudad["id"]."'>".$registroCiudad["nombre_ciudad"]."</option>";
}
?>

