function insertRol() {

	$('.mensaje').remove();
	//declaro variable
	var rol_descripcion = $('#rol_descripcion').val();
	
	//alert(rol_descripcion);

	
	//valido que no este vacio
	var expresNum= /^[a-zA-Z ]*$/;
	if (rol_descripcion=='' || rol_descripcion==null) {
		//alert('no debe estae en blanco')
		cambiarColor('rol_descripcion');
		mostrarMsj('El Campo no debe estar vacio','rol_descripcion');
		//return false;
	}else if (!expresNum.test(rol_descripcion)) {
		cambiarColor('rol_descripcion');
		mostrarMsj('Debe ingresar solo letras','rol_descripcion');
		return false;
				
	} 
	
}

function cambiarColor(vari){
	alert('entro cambiar color');
	
		$('#' + vari).css({
			border: "1px solid #dd5144"

		});
}

        //funcion mostrar campo
		function mostrarMsj(mens,campo){
			$('#' + campo).before('<div class="mensaje text-danger mt-1">'+mens+'</div>');

		}