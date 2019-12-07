<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="POST" action="insert.php">
	<input type="text" name="rol_descripcion">
	<input type="submit" name="btn1">
</form>
	
<?php

if(isset($_POST['btn1'])) {
	include("config/class.conexion.php");

	$rol_descripcion=$_POST['rol_descripcion'];
	$id=$_POST['id'];

	$conexion->query("INSERT INTO roles (id,rol_descripcion) values ('$id =''','$rol_descripcion')");
	mysql_close($conexion);
	echo "correcto";
}
?>	

</body>
</html>