


$(document).ready(function(){
/*FORM CREAR PRODUCTO*/

//Rellenando selects

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


//Fin Rellenando selects



// comprobando campos correctos
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
 			if (imagenes[i]==$("#files").val().toString().slice(-3)) {
 				var esimagen=true;
 				break;
 			}
   		}
   		if (esimagen!=true) {
   			mensaje = mensaje +"Una imagen valida debe tener como extensión .gif, .png o .jpg";
   				    	comprobando=false;

   		}
   		if (comprobando==false) {
   			 swal("ERROR", mensaje);
   			 e.preventDefault();
   		}
   		else{
   			e.preventDefault();
		var json={"nombre_producto":$("#form_nombre_producto").val(),"color":$("#form_color_producto").val(),"id_estilo":$("#form_estilo_producto").val(),"precio":$("#form_precio_producto").val(),"descripcion":$("#form_desc_producto").val(),"composicion":$("#form_composicion_producto").val(),"genero":$("#form_genero_producto").val(),"id_tipo_producto":$("#form_tipo_producto").val(),"imagen":localStorage.imagen_subida}
	   		ajaxQuery("Administracion/crear_producto",json)
				.then(function(devuelto){
					
				swal("Operación correcta!", "Producto creado");

			});
	
   		}
   })

/*FIN FORM CREAR PRODUCTO*/
 document.getElementById('files').addEventListener('change', archivo);

function archivo(evt) {
      var files = evt.target.files;
       
      for (var i = 0, f; f = files[i]; i++) {         
           if (!f.type.match('image.*')) {
                continue;
           }
       
           var reader = new FileReader();
           var img=document.createElement("img")
           reader.onload = (function(theFile) {
               return function(e) {
               	localStorage.setItem("imagen_subida",e.target.result)
               };
           })(f);
 
           reader.readAsDataURL(f);
       }
}
 




/*FORMULARIO EDITAR USUARIO*/
$("button#edituser").click(function(){
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
			$("input[name='id_usuario']").val(array[0].id_usuario)
		}
			
	});
})

$("#guardar_cambios_usuario").click(function(){
	var x=$("#form_editar_usuario").serializeArray()
		ajaxQuery("Administracion/editar_usuario",x)
		.then(function(devuelto){
		swal("Operación correcta!", "Datos de "+devuelto+" modificados.", "success");
			
	});
})
/*FIN FORMULARIO EDITAR USUARIO*/

/*BORRAR USUARIO*/
$(".deleteuser").click(function(){
	if(this.value==1){
   		swal("ERROR", "El administrador no se puede eliminar.");		
	}
	else{
		swal({
		  title: "Vas a eliminar un usuario, ¿estas seguro?",
		  text: "Una vez eliminado no se podra recuperar el usuario",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((eliminar) => {
		  if (eliminar) {
		  	ajaxQuery("Administracion/eliminar_usuario",{"id_usuario":this.value})
				.then(function(devuelto){			
			});
		    swal("¡Usuario eliminado!", {
		      icon: "success",
		    });
		    //location.reload();
		  } else {
		    swal("Has cancelado la operación.");
		  }
		});
	}
})
/*FIN BORRAR USUARIO*/

/*FORMULARIO AÑADIR USUARIO*/

$("#btn_crear_usuario").click(function(){
	var x=$("#form_crear_usuario").serializeArray()
		ajaxQuery("Administracion/crear_usuario",x)
		.then(function(devuelto){
		swal("Operación correcta!", "Usuario "+devuelto+" creado.", "success");
		//location.reload();

	});
})
/*FIN FORMULARIO AÑADIR USUARIO*/





/*Mostrar articulo segun click*/
$(".mostrar").click(function(e){
	$(".configuraciones_panel_admin").addClass("form_oculto")
	e.preventDefault();
	$("."+this.id).removeClass('form_oculto')
})










});