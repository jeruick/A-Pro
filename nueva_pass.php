<?php
require_once("conexion.php");

if(isset($_GET["texto1"]) && isset($_GET["texto2"]))
{
  if($_GET["texto1"] != "" &&  $_GET["texto2"] != "")
  {	
	if($_GET["texto1"] != $_GET["texto2"]){
		echo "Las contraseñas no coinciden";
	}
	else{ echo "Correcto"; }
  } 
}
 ?>
