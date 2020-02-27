<?php
include("../config/class.conexion.php");
if (!empty($_POST)) {
	
	$id_usuarios=$_POST['id_usuarios'];
	$nombre_usuario=$_POST['nombre_usuario'];
	$email=$_POST['email'];
	$contraseña=$_POST['contraseña'];
	$activo=$_POST['activo'];

	$id_clientes=$_POST['id_clientes'];
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$calle=$_POST['calle'];
	$barrio=$_POST['barrio'];
	$localidad=$_POST['localidad'];
	

	echo("SELECT * FROM usuarios WHERE (nombre_usuario='$nombre_usuario' AND id !='$id_usuarios') or (email='$email' AND id !='$id_usuarios')");
	$query_verifico=mysqli_query($conexion,"SELECT * FROM usuarios WHERE (nombre_usuario='$nombre_usuario' AND id !='$id_usuarios') or (email='$email' AND id !='$id_usuarios')");
	
	$result_filas_verifico=mysqli_num_rows($query_verifico);
	if ($result_filas_verifico==0) {

		//codigo de foto
		$nombre_imagen=$_FILES['imagen']['name'];
		$tipo_imagen  =$_FILES['imagen'] ['type'];
		$tamagno_imagen  =$_FILES['imagen'] ['size'];

		$carpeta_destino=$_SERVER['DOCUMENT_ROOT']. '../gimnsoftware/uploads/';
		move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_imagen);


		//echo " puede actualizar existe correo".$result_filas_verifico.'<br>'."UPDATE clientes SET id_clientes='$id_clientes', nombre='$nombre',apellido='$apellido',calle='$calle',barrio='$barrio',localidad='$localidad',foto='$nombre_imagen' WHERE id='$id_clientes'";
		

		$query_update_cliente=mysqli_query($conexion, "UPDATE clientes SET id='$id_clientes', nombre='$nombre',apellido='$apellido',calle='$calle',barrio='$barrio',localidad='$localidad',foto='$nombre_imagen' WHERE id='$id_clientes'");


		//verifico que se ejecute query cliente correcto
		if ($query_update_cliente ) {
			//echo 'update usuarios '."UPDATE usuarios SET id='$id_usuarios',nombre_usuario='$nombre_usuario',email='$email',contraseña='$contraseña',activo='$activo'";

		$query_update_usuario=mysqli_query($conexion,"UPDATE usuarios SET id='$id_usuarios',nombre_usuario='$nombre_usuario',email='$email',contraseña='$contraseña',activo='$activo' WHERE id='$id_usuarios'");
		}else{
			//echo('<p class="alert alert-warning fade show"> ERROR  QUERY usuarios</p>');
		}

		//verifico que se ejecute query cliente correcto
		if ($query_update_usuario ) {
		echo('<p class="alert alert-success fade show"> actualizacion correcta</p>');
		}else{
			echo('<p class="alert alert-warning fade show"> ERROR NO SE ACTUALIZO</p>');
		}
		


	}else{
		echo('<p class="alert alert-warning fade show"> ERROR NO SE ACTUALIZO, YA EXISTE UN CORREO O NOMBRE DE USUARIO IGUAL</p>');
	}
    
}


//verifico que no se ingrese id vacio desde url
if(empty($_REQUEST['id_usuarios'])) {
	echo('<p class="alert alert-success alert-warning fade show">ERROR ID VACIA</p>');
}

//guardo id...verifico que haya registros para llenar campos
$id=$_REQUEST['id'];

$query=mysqli_query($conexion,"SELECT (c.id) as id_clientes, c.nombre,c.apellido,c.calle,c.barrio,
								c.localidad,c.usuario_id,c.foto,(u.id) as id_usuarios, u.email,
								u.contraseña,u.activo, u.nombre_usuario FROM clientes c INNER JOIN
								usuarios u on c.usuario_id=u.id WHERE c.id='$id'");
if ($query) {
	echo "QUERY CORRECTO";
}

$result_fila_query=mysqli_num_rows($query);
	if ($result_fila_query==0) {
	
		echo "CERO REGISTRO";
	}else{
		echo "HAY REGISTRO".'<br>';
		
		//guarda cada campo de la sql en variable
		while ($data_c_u=mysqli_fetch_array($query)) {

			$id_clientes=$data_c_u['id_clientes'];
			$nombre=$data_c_u['nombre'];
			$apellido=$data_c_u['apellido'];
			$calle=$data_c_u['calle'];
			$barrio=$data_c_u['barrio'];
			$localidad=$data_c_u['localidad'];
			$ruta_img=$data_c_u['foto'];

			$id_usuarios=$data_c_u['id_usuarios'];
			$email=$data_c_u['email'];
			$contraseña=$data_c_u['contraseña'];
			$activo=$data_c_u['activo'];
			$nombre_usuario=$data_c_u['nombre_usuario'];

		}
		
echo'muestra'.$nombre;












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
			<input type="hidden" name="id_usuarios" value="<?php echo $id_usuarios; ?>">

			<input type="text" class="form-control " name="nombre_usuario" id="nombre_usuario" placeholder="Ingrese Nombre Usuario" value="<?php echo $nombre_usuario; ?>">

			<input type="email" class="form-control " name="email" id="email" placeholder="Ingrese Correo Electronico valido" value="<?php echo $email; ?>">

			<input type="password" class="form-control " name="contraseña" id="contraseña" placeholder="Ingrese Contraseña" value="<?php echo $contraseña; ?>">

			<label><input type="checkbox" class="form-check-input ml-1 m" name="activo" id="activo" placeholder="estado" value="1" style="position: relative;"> Estado de la persona</label><br>

			<input type="hidden" name="id_clientes" value="<?php echo $id_clientes; ?>">

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