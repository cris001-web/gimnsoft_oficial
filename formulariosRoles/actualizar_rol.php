<?php
include("../config/class.conexion.php");
//si esta correcto
if (!empty($_POST)) {
	if (!empty($_POST['rol_descripcion'])) {
		echo "todos los campos estan llenos";

		$id=$_POST['id'];
		$rol_descripcion=$_POST['rol_descripcion'];
		

		//verificon con query si existe rol_descripcion con ese id
		$sqll=mysqli_query($conexion, "SELECT id, rol_descripcion FROM roles WHERE rol_descripcion='$rol_descripcion' ");
		echo "SELECT id, rol_descripcion FROM roles WHERE rol_descripcion='$rol_descripcion'";
		
		$filas=mysqli_num_rows($sqll);
		//echo $filas;
			if ($filas>0) {
				echo "no se puede actualizar";
				echo "<br>"."UPDATE roles SET id=$id, rol_descripcion='$rol_descripcion' WHERE id=$id";
			}else{
				echo "<br>"."UPDATE roles SET id=$id, rol_descripcion='$rol_descripcion' WHERE id=$id";
				$sql_update=mysqli_query($conexion,"UPDATE roles SET id=$id, rol_descripcion='$rol_descripcion' WHERE id=$id");

				if ($sql_update) {
					echo "se actualizo";
				}else{
					echo "no se actualizo";
				}
			}
	}
}
//mostrar id q no sea enviado vacio
 if (empty($_GET['id'])) {//si no existe redirecciona
	//echo "enmtrooo";
	echo "id vacia";
	//header('Location:listar.php');
}

//verificar que id este con valores
 $id= $_GET['id'];

 $sql = mysqli_query($conexion, "SELECT id, rol_descripcion FROM roles WHERE id=$id");

$result_fila_sql= mysqli_num_rows($sql);// cuento cuantas filas hay en sql

 if ($result_fila_sql ==0) {//no hay registro 
	header('Location:listar.php');
//     echo 'no hay tabla';
}else{//si hay toma los registro para mostrarlo
$option="";
	while ($data = mysqli_fetch_array($sql)) {
	  	$id = $data['id'];
	  	$rol_descripcion=$data['rol_descripcion'];
	 
	}
  }



?>	 



<!DOCTYPE html>
<html>
<head>
	<title>Actualizar</title>
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
	
</head>
<body>
<div class="container center-block" style="margin-top: 90px;">
	<form action="actualizar_rol.php" method="POST"   style="box-shadow: 1px 2px 6px 0px black; height: 280px;width: 60%;
    margin: auto;">
		
			<h2 class="text-white text-center" style="background: #6f6f6f">Actualizar Rol</h2>
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="form-group mx-2 mt-5">
			<input type="text" class="form-control" name="rol_descripcion" id="rol_descripcion" placeholder="Ingrese Rol Ej.: Administrador o Usuario" value="<?php echo $rol_descripcion; ?>">
		</div>
		<input type="submit"  value="Guardar" class="btn btn-primary btn-lg my-5 mx-2" onclick="return insertRol();  ">
	 
	</form>
	
</div>	


<!-- jquery bootstrap-->
<script src="../bootstrap4/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../validaciones/funciones_validar_rol.js"></script>

</body>
</html>
