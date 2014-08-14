<?php
session_start();
if(isset($_GET['url']))
{
	$url = $_GET['url']; 
	unset($_SESSION["usuario_valido"]);
	unset($_SESSION["nombre_usuario"]);
	
	header("Location: $url");
}
?>