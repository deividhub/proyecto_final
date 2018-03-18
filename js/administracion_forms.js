


$(document).ready(function(){

/*Rellenando selects*/

$("#form_tipo_producto").change(function(){

ajaxQuery("Administracion/estilos",{"id_tipo_producto":$("#form_tipo_producto").val()})
.then(function(devuelto){
	$(".op_eliminar").remove();
	var array=JSON.parse(devuelto);
	for(var i=0;i<array.length;i++){
		$("#form_estilo_producto").append("<option class='op_eliminar' value="+array[i]['id_estilo']+">"+array[i]['descripcion']+"</option>")
	}

});

})


/*Fin Rellenando selects*/



// formulario crear producto
   $("#btn_crear_producto").click(function(e){

   	var mensaje="Errores encontrados: \n";
   	var comprobando=true;

	    if ($("#form_nombre_producto").val().length<10) {
	    	mensaje=mensaje+"Mínimo 5 caracteres\n";
	    	comprobando=false;
	   	}

	   	if ($("#form_estilo_producto").val()==0) {
	   		mensaje=mensaje+"No has seleccionado un estilo\n";
	   			    	comprobando=false;

   		}

   		if ($("#form_color_producto").val().length<3) {
	   		mensaje=mensaje+"No has introducido un color valido\n";
	   			    	comprobando=false;


   		}

	   	if ($("#form_desc_producto").val().length<10) {
	   		mensaje=mensaje+"Mínimo 10 caracteres\n";
	   			    	comprobando=false;


	   	}

	   	if ($("#form_precio_producto").val()<1) {
	  	   	mensaje=mensaje+"Precio incorrecto.\n";
	  	   		    	comprobando=false;


	   	}

	   	if ($("#form_composicion_producto").val().length<5) {
	   		mensaje=mensaje+"Mínimo 5 caracteres.\n";
	   			    	comprobando=false;


	   	}
 	   	if ($("#form_genero_producto").val()==0) {
	   		mensaje=mensaje+"No has seleccionado género.\n";
	   			    	comprobando=false;

   		}
   		imagenes = new Array("gif", "jpg", "JPG","PNG","png","GIF"); 
   		for (var i = 0; i < imagenes.length; i++) {
 			if (imagenes[i]==$("#form_imagen_producto").val().toString().slice(-3)) {
 				var esimagen=true;
 				break;
 			}
   		}
   		if (esimagen!=true) {
   			mensaje = mensaje +"Una imagen valida debe tener como extensión .gif, .png o .jpg";
   				    	comprobando=false;

   		}
   		if (comprobando==false) {
   			 alert(mensaje)
   			 e.preventDefault();
	
   		}
   		else{
	   		
	
   		}
   })









/*FORMULARIO EDITAR USUARIO*/
$("button#edit").click(function(){
	$("#form_editar_usuario").slideDown(2000);
	ajaxQuery("Administracion/obtener_usuario",{"id_usuario":$(this).val()})
		.then(function(devuelto){
		var array=JSON.parse(devuelto);
		for(var i=0;i<array.length;i++){
			$("input[name='nombre']").val(array[0].nombre)
			$("input[name='apellidos']").val(array[0].apellidos)
			$("input[name='correo']").val(array[0].correo)
			$("input[name='fecha_nac']").val(array[0].fecha_nac)
			$("input[name='telefono']").val(array[0].telefono)
			$("input[name='domicilio']").val(array[0].domicilio)
			$("input[name='provincia']").val(array[0].provincia)
			$("input[name='localidad']").val(array[0].localidad)
			$("#guardar_cambios_usuario").val(array[0].id_usuario)
		}
			
	});
})

$("#guardar_cambios_usuario").click(function(){
	var x=$("#form_editar_usuario").serializeArray()
		ajaxQuery("Administracion/editar_usuario",x)
		.then(function(devuelto){
			alert(devuelto)
		alert("Datos modificados")
			
	});
})






});