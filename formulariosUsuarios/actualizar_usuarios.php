<?php 
include("../config/class.conexion.php");
if (!empty($_POST)) {
	$id_clientes=$_POST['id_c'];
	echo('id_clientes'.$id_clientes.'<BR>');
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$calle=$_POST['calle'];
	$barrio=$_POST['barrio'];
	$localidad=$_POST['localidad'];
	$ruta_img=$_POST['foto'];

	$id_usuarios=$_POST['id_u'];
	echo('id_usuarios'.$id_usuarios);
	$email=$_POST['email'];
	$contraseña=$_POST['contraseña'];
	$activo=$_POST['activo'];
	$nombre_usuario=$_POST['nombre_usuario'];

	//codigo de foto
	$nombre_imagen=$_FILES['imagen']['name'];
	$tipo_imagen  =$_FILES['imagen'] ['type'];
 	$tamagno_imagen  =$_FILES['imagen'] ['size'];

 	$carpeta_destino=$_SERVER['DOCUMENT_ROOT']. '../gimnsoftware/uploads/';
 	move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_imagen);


		//verifico que el nombre de usuario y correo no esten en la bd
		$query_verifico=mysqli_query($conexion,"SELECT (id) as id_u, nombre_usuario,email FROM usuarios WHERE (									nombre_usuario='$nombre_usuario' AND id !='$id_usuarios') or 
											(email='$email' AND id !='$id_usuarios')");

		$result_filas_verifico=mysqli_num_rows($query_verifico);
		if ($result_filas_verifico==0) {
			echo " puede actualizar no existe correo".'<BR>';

			//actualizo clientes

			$query_update_clientes=mysqli_query($conexion,"UPDATE clientes SET id='$id_clientes', nombre='$nombre',apellido='$apellido',calle='$calle',barrio='$barrio',localidad='$localidad',foto='$nombre_imagen' WHERE id='$id_clientes'");

				//verifico que query cliebntes sea correcto y si es hago query usuarios
				if ($query_update_clientes) {
					//echo "QUERY clientes CORRECTO".'<BR>';
					$query_update_usuarios=mysqli_query($conexion,"UPDATE usuarios SET id='$id_usuarios',nombre_usuario='$nombre_usuario',email='$email',contraseña='$contraseña',activo='$activo' WHERE id='$id_usuarios'");

						if ($query_update_usuarios) {
							echo "QUERY  usuarios CORRECTO".'<BR>';
						}else{
							echo "NO SE PUDO ACTUALIZAR".'<BR>';
						}	
				

				}else{
					echo "NO SE PUDO ACTUALIZAR".'<BR>';
				}
		}else{
			echo "EXISTE CORREO";
		}
	

}






//VERIFICA SI ID VACIA Y CARGA DATOS A INPUTS
if (!empty($_REQUEST['id_usuario_get'])) {
	$id_usuario_get=$_REQUEST['id_usuario_get'];
	//echo($id_usuario_get);

	//echo "SELECT usuarios.id, usuarios.email, usuarios.contraseña,usuarios.activo,usuarios.nombre_usuario,					clientes.id, clientes.nombre,clientes.apellido,clientes.calle,clientes.barrio,			 				clientes.localidad,clientes.usuario_id,clientes.foto FROM usuarios INNER JOIN clientes on 				usuarios.id=clientes.usuario_id WHERE usuarios.id='$id_usuario_get'".'<br>';
	$query=mysqli_query($conexion,"SELECT (usuarios.id) as id_u, usuarios.email, usuarios.contraseña,
									usuarios.activo,usuarios.nombre_usuario,(clientes.id) as id_c, clientes.nombre,clientes.apellido,clientes.calle,clientes.barrio, clientes.localidad,clientes.usuario_id,clientes.foto FROM usuarios INNER JOIN clientes on usuarios.id=clientes.usuario_id WHERE usuarios.id='$id_usuario_get'");

	//guarda cada campo de la sql en variable
	 		while ($data_c_u=mysqli_fetch_array($query)) {

	 			$id_clientes=$data_c_u['id_c'];
	 			//echo('id_clientes'.$id_clientes.'<BR>');
	 			$nombre=$data_c_u['nombre'];
	 			$apellido=$data_c_u['apellido'];
	 			$calle=$data_c_u['calle'];
	 			$barrio=$data_c_u['barrio'];
				$localidad=$data_c_u['localidad'];
	 			$ruta_img=$data_c_u['foto'];

				$id_usuarios=$data_c_u['id_u'];
				//echo('id_usuarios'.$id_usuarios);
	 			$email=$data_c_u['email'];
	 			$contraseña=$data_c_u['contraseña'];
	 			$activo=$data_c_u['activo'];
	 			$nombre_usuario=$data_c_u['nombre_usuario'];

	 		}

}else{
	echo('<p class="alert alert-success alert-warning fade show">ID VACIA</p>');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Actualizar Usuarios</title>
<!-- bootstrap -->
<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">	
<link rel="stylesheet" type="text/css" href="../style/estilo_foto.css">
<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>

</head>
<body>
<div class="container center-block" style="margin-top: 90px;">
	<form action="actualizar_usuarios.php" method="POST" style="box-shadow: 1px 2px 6px 0px black; height: 500px;width: 60%;
    margin: auto;" enctype="multipart/form-data">
		<h2 class="text-white text-center" style="background: #6f6f6f">Actualizar Usuarios-Cliente</h2>

		<div class="form-group mx-2 mt-3" >
			<input type="hidden" name="id_u" value="<?php echo $id_usuarios; ?>">

			<input type="text" class="form-control " name="nombre_usuario" id="nombre_usuario" placeholder="Ingrese Nombre Usuario" value="<?php echo $nombre_usuario; ?>">

			<input type="email" class="form-control " name="email" id="email" placeholder="Ingrese Correo Electronico valido" value="<?php echo $email; ?>">

			<input type="password" class="form-control " name="contraseña" id="contraseña" placeholder="Ingrese Contraseña" value="<?php echo $contraseña; ?>">

			<label><input type="checkbox" class="form-check-input ml-1 m" name="activo" id="activo" placeholder="estado" value="1" style="position: relative;"> Estado de la persona</label><br>

			<input type="hidden" name="id_c" value="<?php echo $id_clientes; ?>">

			<input type="text" class="form-control " name="nombre" id="nombre" placeholder="Ingrese Nombre del Cliente" value="<?php echo $nombre; ?>">

			<input type="text" class="form-control " name="apellido" id="apellido" placeholder="Ingrese apellido del Cliente" value="<?php echo $apellido; ?>">

			<input type="text" class="form-control " name="calle" id="calle" placeholder="Calle del cliente" value="<?php echo $calle; ?>">

			<input type="text" class="form-control " name="barrio" id="barrio" placeholder="Barrio del Cliente" value="<?php echo $barrio; ?>">

			<input type="text" class="form-control " name="localidad" id="localidad" placeholder="Ingrese Ciudad del Cliente" value="<?php echo $localidad; ?>">

			<div id="imagePreview" style="text-align: center;">
				<img src="../uploads/<?php echo $ruta_img; ?>" width="100"/>
			</div>
			<div class="photo" >
				<input type="file" name="imagen" id="imagen" width="100" />
			</div>
			
			<input type="submit"  value="Actualizar" class="btn btn-primary btn-lg my-5 mx-2"  >
		</div>
	</form>
	
</div>

<!-- bootstrap jquery -->
<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>

<script type="text/javascript" src="../javascript/foto.js"></script>

</body>
</html>