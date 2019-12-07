<?php
$host='localhost';
$basededatos='gimnsoft_php';
$usuario='root';
$pass='';

$conexion = new msqli($host,$basededatos,$usuario,$pass);

if ($conexion->connect_errno) {
	echo "nuestro experimenta fallos";
	exit();
}
?>