


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
					
			swal("Operación correcta!", "Producto creado.", "success")
				.then((value) => {
					form_anterior(".crear_product")
			});	

			});
	
   		}
   })

/*FIN FORM CREAR PRODUCTO*/
 document.getElementById('files').addEventListener('change', archivo);

function archivo(evt) {
	localStorage.removeItem("comentarios")

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
 

/*FORMULARIO EDITAR PRODUCTO*/
$("button#editproduct").click(function(){
	$("#form_editar_producto").slideDown(2000);
	ajaxQuery("Administracion/obtener_producto",{"id_producto":$(this).val()})
		.then(function(devuelto){
		var array=JSON.parse(devuelto);
		for(var i=0;i<array.length;i++){
			$("input[name='nombre_producto']").val(array[0].nombre_producto)
			$("input[name='genero']").val(array[0].genero)
			$("input[name='id_tipo_producto']").val(array[0].id_tipo_producto)
			$("input[name='color']").val(array[0].color)
			$("input[name='precio']").val(array[0].precio)
			$("input[name='descripcion']").val(array[0].descripcion)
			$("input[name='id_estilo']").val(array[0].id_estilo)
			$("input[name='composicion']").val(array[0].composicion)
			$("input[name='id_producto']").val(array[0].id_producto)
		}
			
	});
})

$("#guardar_cambios_producto").click(function(){
	var json={"id_producto":$("input[name='id_producto']").val(),"nombre_producto":$("input[name='nombre_producto']").val(),"color":$("input[name='color']").val(),"id_estilo":$("input[name='id_estilo']").val(),"precio":$("input[name='precio']").val(),"descripcion":$("input[name='descripcion']").val(),"composicion":$("input[name='composicion']").val(),"genero":$("input[name='genero']").val(),"id_tipo_producto":$("input[name='id_tipo_producto']").val(),"imagen":localStorage.imagen_subida}
		ajaxQuery("Administracion/editar_producto",json)
		.then(function(devuelto){
		swal("Operación correcta!", "Datos de "+devuelto+" modificados.", "success")
			.then((value) => {
				form_anterior(".list_product")
		});		
	});
})

$("#filesimg").change(archivo);
/*FIN FORMULARIO EDITAR PRODUCTO*/

/*BORRAR PRODUCTO*/
$(".deleteproduct").click(function(){
		swal({
		  title: "Vas a eliminar un producto, ¿estas seguro?",
		  text: "Una vez eliminado no se podra recuperar el producto",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((eliminar) => {
		  if (eliminar) {
		  	ajaxQuery("Administracion/eliminar_producto",{"id_producto":this.value})
				.then(function(devuelto){			
			});
			swal("Operación correcta!", "Producto eliminado.", "success")
				.then((value) => {
					form_anterior(".list_product")
			});
		    //location.reload();
		  } else {
		    swal("Has cancelado la operación.");
		  }
		});
})
/*FIN BORRAR PRODUCTO*/













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
		swal("Operación correcta!", "Datos de "+devuelto+" modificados.", "success")
			.then((value) => {
				form_anterior(".list_user")
		});
			
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
			swal("Operación correcta!", "Usuario eliminado", "success")
				.then((value) => {
					form_anterior(".list_user")
			});

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
		swal("Operación correcta!", "Usuario "+devuelto+" creado.", "success")
			.then((value) => {
				form_anterior(".crear_user")
		});

	});
})
/*FIN FORMULARIO AÑADIR USUARIO*/







/* FORMULARIO COMENTARIOS*/
$(".deletecomment").click(function(){

	swal({
	  title: "Vas a eliminar un comentario, ¿estas seguro?",
	  text: "Recuerda eliminar solo comentarios ofensivos",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((eliminar) => {
	  if (eliminar) {
	  	ajaxQuery("Administracion/eliminar_comentario",{"id_comentario":this.value})
			.then(function(devuelto){			
		});
		swal("Operación correcta!", "Comentario eliminado", "success")
			.then((value) => {
				form_anterior(".list_coments")
		});

	  } else {
	    swal("Has cancelado la operación.");
	  }
	});
})
/*FIN FORMULARIO COMENTARIOS*/




/*PEDIDOS*/
var grados=0;
$(".icon_actualizar_estado").click(function() {
	var id="."+this.id;
	
	if($(id+" select").val()==4 || $(id+" select").val()==5){
		swal("El pedido ya ha finalizado o ha sido cancelado")
	}

	else{
		var estado_nuevo=parseInt($(id+" select").val())+1;
		ajaxQuery("Administracion/actualizar_pedido",{"pedido":id.substr(-1),"state":estado_nuevo})
			.then(function(devuelto){			
		});
		$(id+" select").css("color","lightgreen")
		$(id+" select").val(estado_nuevo)
		grados=grados+360;
   		$(this).css({'transition' : '1s'});
    	$(this).css({'transform' : 'rotate('+grados+'deg)'});
	}



});



$(".icon_bloquear_estado").click(function() {
	var id="."+this.id;
	if($(id+" select").val()==4 || $(id+" select").val()==5){
		swal("Este pedido ya ha finalizado o ha sido cancelado")
	}
	else{
		swal({
		  title: "Vas a cancelar un pedido, ¿estas seguro?",
		  text: "",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((cancelar) => {
		  if (cancelar) {
			ajaxQuery("Administracion/actualizar_pedido",{"pedido":id.substr(-1),"state":5})
				.then(function(devuelto){			
			});
			$(id+" select").val(5)
			$(id+" select").css("color","red")	
		  } else {
		    swal("Has cancelado la operación.");
		  }
		});


	}




});
/*FIN PEDIDOS*/




















/*FUNCIONES COMUNES*/
function form_anterior(form){
	localStorage.setItem("actual_form", form)
	location.reload()
}


if(localStorage.actual_form){
	$(localStorage.actual_form).removeClass('form_oculto')
}

/*Mostrar segun click*/
$(".mostrar").click(function(e){
	$(".configuraciones_panel_admin").addClass("form_oculto")
	e.preventDefault();
	$("."+this.id).removeClass('form_oculto')
	$(".show-options").removeClass("show-options")
})


$("#aside_panel_admin ul li").click(function(e){
	e.preventDefault()
		$(".show-options").removeClass("show-options")
		$(this).addClass("show-options")
})






});