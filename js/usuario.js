$(document).ready(function(){

if(!localStorage.user){
	$(".tooltiptext").text("Inicia sesión")
	$("#log_perfil a").prop("href", base_url+"Principal/login_registro")
	$(".cerrar_sesion").hide()
	$("#btn_pasar_a_caja").prop("disabled","disabled")
	$("#btn_pasar_a_caja").text("No has iniciado sesión")
}

//al iniciar sesion se crean estos elementos
// localStorage.setItem("AUTH",true) //controla si estas autentificado
 //var array=[{"id_usuario":2,"Nombre":"Cliente","apellidos":"ape apello","correo":"abcd@gmail.com","fecha_nacimiento":"2001-01-01","domicilio":"c/Kalea","provincia":"Bizkaia","localidad":"Bilbao"}]
 //localStorage.setItem("user",JSON.stringify(array)) //aqui se guardan todos los datos del usuario
 

if(localStorage.user){
var datos_usuario = JSON.parse(localStorage.user)
// cargar perfil usuario
$(".form_client #form_nombre_cliente").val(datos_usuario[0].nombre);
$(".form_client #form_apellidos_cliente").val(datos_usuario[0].apellidos);
$(".form_client #form_fecha_cliente").val(datos_usuario[0].fecha_nac);
$(".form_client #form_domicilio_cliente").val(datos_usuario[0].domicilio);
$(".form_client #form_localidad_cliente").val(datos_usuario[0].localidad);
$(".form_client #form_provincia_cliente").val(datos_usuario[0].provincia);
$(".form_client #form_correo_cliente").val(datos_usuario[0].correo);
$(".form_client #form_telefono_cliente").val(datos_usuario[0].telefono);
$(".form_client #id_usuario").val(datos_usuario[0].id_usuario);
}











$("#recuperar_pass").click(function(e){
swal({
  title: 'Introduce tu correo electronico:',
  input: 'email',
  inputPlaceholder: 'dwnpd@dwnpd.com',
  showCancelButton: true,
  confirmButtonText: 'Recuperar',
  showLoaderOnConfirm: true,
    inputValidator: (value) => {
    return !value && '¡Introduce un correo válido!'
  }
}).then((result) => {
  if (result.value) {
   	  ajaxQuery("Principal/recuperar_pass",{"correo":result.value})
		.then(function(devuelto){
			alert(devuelto+"  usuario.js linea 47 borrar")
			if(devuelto==1){

				swal("Lo sentimos, este usuario parece no estar registrado.")
			}
			else{
			 	swal("¡Perfecto!","Revisa tu bandeja de entrada, te hemos enviado un correo de recuperacion de contraseña","success")
			}
			

	});
  }
})
});



$(".cerrar_sesion").click(function(){

  ajaxQuery("Principal/cerrar_sesion")
	.then(function(devuelto){
		console.log(devuelto)
		swal("¡Hasta pronto!","Sesión cerrada","success")
		.then((value) => {
			localStorage.removeItem("user");
			localStorage.removeItem("productos");
			location.href='/proyecto_final/index.php/Principal'
		});

	});

})


ajaxQuery("Principal/comprobar_login")
.then(function(devuelto){
	if(devuelto=="false"){
		localStorage.removeItem('user')
	}

});


/*Editar usuario*/

$("#btn_guardar_datos").click(function(e){

	e.preventDefault();
	var error = false;
	var mensaje = "";
	var datos_usuario = $("#form_client").serializeArray()

	if(datos_usuario[0].value.length == 0){
		error = true;
		mensaje = "<p>El nombre no puede estar vacío. </p>";
	}	

	if(datos_usuario[1].value.length == 0){
		error = true;
		mensaje += "<p>Los apellidos no pueden estar vacíos. </p>";
	}
	else if(datos_usuario[1].value.trim().split(" ").length<2){
		error = true;
		mensaje += '<p>Introduce 2 apellidos. </p>'
	}

	if(datos_usuario[2].value == ""){
		error = true;
		mensaje += "<p>La fecha no puede estar vacía. </p>";
	}	

	if(datos_usuario[3].value.length < 6){
		error = true;
		mensaje += "<p>El domicilio tiene que tener una dirección completa. </p>";
	}

	if(datos_usuario[4].value.length == 0){
		error = true;
		mensaje += "<p>La provincia no pueden estar vacía. </p>";
	}

	if(datos_usuario[5].value.length == 0){
		error = true;
		mensaje += "<p>La localidad no puede estar vacía. </p>";
	}	

	if(datos_usuario[6].value.length < 6){
		error = true;
		mensaje += "<p>El correo tiene que tener un formato correcto (ejemplo@ejemplo.com). </p>";
	}

	if(datos_usuario[7].value.length < 9){
		error = true;
		mensaje += "<p>El teléfono tiene que tener 9 números. </p>";
	}

	if(error){
		swal({
			type: 'error',
			title: 'Oops...',
			html: mensaje,
		})
	}

	else{

		var json = {}
		for (var i = 0; i < datos_usuario.length; i++) {
			json[i]=datos_usuario[i];
		}
		console.log(json)

		ajaxQuery("Usuario/guardar_datos",json)
		.then(function(devuelto){
			swal({
			  position: 'top-end',
			  type: 'success',
			  title: 'Datos modificados',
			  showConfirmButton: false,
			  timer: 1500
			})
		});
	}

})

/*Fin editar usuario*/

$("#btn_rec_contraseña").click(function(){
	swal.mixin({
		  input: 'password',
		  confirmButtonText: 'Siguiente &rarr;',
		  cancelButtonText: 'Cancelar',
		  showCancelButton: true,
		  progressSteps: ['1', '2']
		}).queue([
		  {
		    title: 'Recuperar contraseña',
		    text: 'Introduce una nueva contraseña'
		  },
		  'Introducela de nuevo',
		]).then((result) => {
		  if (result.value) {
		  	if(result.value[0]==result.value[1]){
		  		ajaxQuery("Usuario/recuperar_contrasena",{"pass":result.value[1]})
					.then(function(devuelto){
						swal({
					      title: '¡Perfecto!',
					      html:
					        'Tu contraseña ha sido modificada con exito.',
					      confirmButtonText: 'Ok!'
					    })

				});
		  	}
		  	else{
		  		swal({
				  type: 'error',
				  title: 'Oops...',
				  text: '¡Las contraseñas no coinciden!',
				})
		  	}
		  }
	})
})



/*FUNCIONES PANEL USUARIO*/

/*
ajaxQuery("Usuario/pedidos")
.then(function(devuelto){
	var array_pedidos=JSON.parse(devuelto);
	for (var i = 0; i < array_pedidos.length; i++) {

		ajaxQuery("Usuario/productos_del_pedido",{"id_pedido":array_pedidos[i].id_pedido})
		.then(function(devuelto){
			var array_productos=JSON.parse(devuelto);

		});

	}
});





ajaxQuery("Usuario/obtener_comentarios")
.then(function(devuelto){
	var array_comentarios=JSON.parse(devuelto);

});




*/

$(".favoritos_cliente").click(function(){
	ajaxQuery("Usuario/favoritos")
	.then(function(devuelto){
		var array_favoritos=JSON.parse(devuelto);

		for (var i = 0; i < array_favoritos.length; i++) {
			
			$("#productos_favoritos_scroll").append("<article id='favorito_cliente'><a href=''><img src='"+array_favoritos[i].imagen+"'></a><article id='informacion_favorito'><p><b>Nombre:</b> "+array_favoritos[i].nombre_producto+"</p><p><b>Descripción:</b> "+array_favoritos[i].descripcion+"</p><p><b>Composición:</b> "+array_favoritos[i].composicion+"</p><p><b>Color:</b> "+array_favoritos[i].color+"</p><p><b>Género:</b> "+array_favoritos[i].genero+"</p><p><b>Precio:</b> "+array_favoritos[i].precio+"</p></article></article>");
			$("#productos_favoritos_scroll").append("<article id='favorito_cliente'><a href=''><img src='"+array_favoritos[i].imagen+"'></a><article id='informacion_favorito'><p><b>Nombre:</b> "+array_favoritos[i].nombre_producto+"</p><p><b>Descripción:</b> "+array_favoritos[i].descripcion+"</p><p><b>Composición:</b> "+array_favoritos[i].composicion+"</p><p><b>Color:</b> "+array_favoritos[i].color+"</p><p><b>Género:</b> "+array_favoritos[i].genero+"</p><p><b>Precio:</b> "+array_favoritos[i].precio+"</p></article></article>");
			$("#productos_favoritos_scroll").append("<article id='favorito_cliente'><a href=''><img src='"+array_favoritos[i].imagen+"'></a><article id='informacion_favorito'><p><b>Nombre:</b> "+array_favoritos[i].nombre_producto+"</p><p><b>Descripción:</b> "+array_favoritos[i].descripcion+"</p><p><b>Composición:</b> "+array_favoritos[i].composicion+"</p><p><b>Color:</b> "+array_favoritos[i].color+"</p><p><b>Género:</b> "+array_favoritos[i].genero+"</p><p><b>Precio:</b> "+array_favoritos[i].precio+"</p></article></article>");
		}

	});
})


});




