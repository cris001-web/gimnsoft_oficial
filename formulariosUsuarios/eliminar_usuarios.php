<?php include("../config/class.conexion.php");?>
<?php 
if (!empty($_POST)) {
	$id_usuarios = $_POST['id_u'];
	$id_clientes = $_POST['id_c'];
	echo 'id_clientes'.$id_clientes;
	
	echo "DELETE FROM usuarios WHERE id='$id_usuarios'".'<br>';
	echo "DELETE FROM clientes WHERE id='$id_clientes".'<br>';
	

	$query_eliminar_usuarios = mysqli_query($conexion,"DELETE FROM usuarios WHERE id='$id_usuarios'");
	
		if ($query_eliminar_usuarios) {
			
			echo "DELETE FROM clientes WHERE id='$id_clientes".'<br>';
			
			$query_eliminar_clientes = mysqli_query($conexion,"DELETE FROM usuarios WHERE id='$id_clientes'");
				
		}else{
			echo "no se borro";
			
		}
}
//verifico que id no este vacia
if (empty($_REQUEST['id_usuario_get'])) {
	
	echo "id vacia";
	# code...
}else{
	echo "id no vacia";
	//tomo id
	$id_usuarios=$_REQUEST['id_usuario_get'];
	
	$query_u = mysqli_query($conexion,"SELECT (usuarios.id) as id_u,nombre_usuario FROM usuarios WHERE usuarios.id='$id_usuarios'");
	

	$row_u= mysqli_num_rows($query_u);
	if ($row_u>0) {
		//echo $row;
		while ($data_u= mysqli_fetch_array($query_u)) {
			$id=$data_u['id_u'];
			$nombre_usuario=$data_u['nombre_usuario'];		
		}
		$query_c = mysqli_query($conexion,"SELECT (clientes.id) as id_c,nombre FROM clientes WHERE usuario_id='$id_usuarios'");
		//echo "SELECT (clientes.id) as id_c,nombre FROM clientes WHERE usuario_id='$id_usuarios'";
	
		$row_c= mysqli_num_rows($query_c);
			if ($row_c>0) {
				//echo $row;
				while ($data_c= mysqli_fetch_array($query_c)) {
					$id_clientes=$data_c['id_c'];
					
					$nombre=$data_c['nombre'];		
				}


			}
	}
}
?>





<!DOCTYPE html>
<html>
<head>
	<title>Eliminar Usuarios</title>
	<link rel="stylesheet" type="text/css" href="../style/style_gral.css">
<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">	
</head>
<body>
	<?php include("../config/class.conexion.php");?>
	<section>
		<div class="mostrar">
			<h2>¿Desea Eliminar Este Usuario-Cliente?</h2>
			<p> Usuario: <span><?php echo $nombre_usuario ?></span></p>
			<p> Nombre: <span><?php echo $nombre ?></span></p>
			<form method="post" action="eliminar_usuarios.php">
				<input type="hidden" name="id_u" value="<?php echo $id;?>">
				<input type="hidden" name="id_c" value="<?php echo $id_clientes;?>">
				<a href="listar_usuario.php" class="btn btn-success">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn btn-success">
			</form>
		</div>	
	</section>


<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>
</body>
</html>