<?php include("../config/class.conexion.php");

if (!empty($_POST)) {
	$id = $_POST['id'];
	echo 'UGH'.$id;
	$query_borrar = mysqli_query($conexion,"DELETE FROM roles WHERE id=$id");
	echo $query_borrar;
		if ($query_borrar) {
			echo "DELETE FROM roles WHERE id=$id";
			//header('location:listar.php');
		}else{
			echo "no se borro";
			echo "DELETE FROM roles WHERE id=$id";
		}
}
if (empty($_REQUEST['id'])) {
	//header('location:listar.php');
	echo "id vacia";
	# code...
}else{
	$id=$_REQUEST['id'];
	//echo "id".$id;
	$query = mysqli_query($conexion,"SELECT * FROM roles WHERE id=$id");

	$row= mysqli_num_rows($query);
	if ($row>0) {
		//echo $row;
		while ($data= mysqli_fetch_array($query)) {
			$id=$data['id'];
			$rol_descripcion=$data['rol_descripcion'];		
		}
	}else{
		header('location:listar.php');
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Eliminar</title>
	<link rel="stylesheet" type="text/css" href="../style/style_gral.css">
<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">	
</head>
<body>
	<?php include("../config/class.conexion.php");?>
	<section>
		<div class="mostrar">
			<h2>¿Desea Eliminar Este Usuario?</h2>
			<p>Nombre del Rol: <span><?php echo $rol_descripcion ?></span></p>
			<form method="post" action="">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<a href="listar.php" class="btn btn-success">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn btn-success">
			</form>
		</div>	
	</section>


<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>
</body>
</html>