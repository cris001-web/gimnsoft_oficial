<?php

$host='localhost';
$basededatos='gimnsoft_2020';
$usuario='root';
$pass='';

error_reporting(0);
$conexion = new mysqli($host,$usuario,$pass,$basededatos);


if ($conexion->connect_errno) {
	echo "nuestro experimenta fallos";
	exit();
}
?>