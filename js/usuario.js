$(document).ready(function(){

	/*VISTA INICIAL*/

		/*Para que no estén marcados los elementos del aside*/
		$(".pedidos_cliente").removeClass("seleccionado_cliente");
		$(".comentarios_cliente").removeClass("seleccionado_cliente");
		$(".favoritos_cliente").removeClass("seleccionado_cliente");

		/*Hacer que sea visible la sección de datos personales*/
		$("#datos_personales").removeClass("ocultar_cliente");

	/*FIN VISTA INICIAL*/


	/*-------------------*/


	/*COMPROBACIÓN INICIO DE SESIÓN*/

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

	/*FIN COMPROBACIÓN INICIO DE SESIÓN*/


	/*--------------------*/


	/*RECUPERAR CONTRASEÑA*/

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

	/*FIN RECUPERAR CONTRASEÑA*/


	/*--------------------*/


	/*CERRAR SESIÓN*/

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

	/*FIN CERRAR SESIÓN*/


	/*------------------*/


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


	/*DATOS PERSONALES*/

		/*ASIDE*/

			$(".datos_personales").click(function(){

				/*Hacer que se quede marcado sólo "Datos personales" en el aside*/
				$(".datos_personales").addClass("seleccionado_cliente");
				$(".pedidos_cliente").removeClass("seleccionado_cliente");
				$(".comentarios_cliente").removeClass("seleccionado_cliente");
				$(".favoritos_cliente").removeClass("seleccionado_cliente");


				/*Hacer que sólo sea visible la sección de datos personales*/
				$("#datos_personales").removeClass("ocultar_cliente");
				$("#pedidos_cliente").addClass("ocultar_cliente");
				$("#comentarios_cliente").addClass("ocultar_cliente");
				$("#favoritos_cliente").addClass("ocultar_cliente");
			})

		/*FIN ASIDE*/


		/*----------*/


		/*BOTÓN GUARDAR*/

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

		/*FIN BOTÓN GUARDAR*/


		/*----------*/


		/*BOTÓN RECUPERAR CONTRASEÑA*/

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

		/*FIN BOTÓN RECUPERAR CONTRASEÑA*/

	/*FIN DATOS PERSONALES*/


	/*--------------------*/


	/*PEDIDOS*/

		$(".pedidos_cliente").click(function(){

			/*Hacer que se quede marcado sólo "Pedidos" en el aside*/
			$(".datos_personales").removeClass("seleccionado_cliente");
			$(".pedidos_cliente").addClass("seleccionado_cliente");
			$(".comentarios_cliente").removeClass("seleccionado_cliente");
			$(".favoritos_cliente").removeClass("seleccionado_cliente");


			/*Hacer que sólo sea visible la sección de pedidos*/
			$("#datos_personales").addClass("ocultar_cliente");
			$("#pedidos_cliente").removeClass("ocultar_cliente");
			$("#comentarios_cliente").addClass("ocultar_cliente");
			$("#favoritos_cliente").addClass("ocultar_cliente");


			/*Llama a la función que obtiene los pedidos*/
			ajaxQuery("Usuario/pedidos")
			.then(function(devuelto){

				var array_pedidos=JSON.parse(devuelto);
				for (var i = 0; i < array_pedidos.length; i++) {

					ajaxQuery("Usuario/productos_del_pedido",{"id_pedido":array_pedidos[i].id_pedido})
					.then(function(devuelto){
						var array_productos=JSON.parse(devuelto);

					});

					/*
					
						Nº Pedido: id_pedido (array_pedidos)
						Fecha: fecha_pedido (array_pedidos)
						Estado: desc_estado (array_pedidos)
						Producto: nombre_producto (array_productos)
						Imágen: imagen (array_productos)
						Precio: precio (array_productos)
						Precio total: precio_total (array_pedidos)

					*/

					/*Rellena el article con los pedidos*/
					$("#pedido_cliente").append("<article><p><b>Estado:</b> "+array_pedidos[i].desc_estado+"</p></article>");
					<h1>Pedido nº "+array_pedidos[i].id_pedido+"</h1>
					<p><p>
				}
			});
		})

	/*FIN PEDIDOS*/


	/*--------------------*/


	/*FAVORITOS*/

		$(".favoritos_cliente").click(function(){

			/*Hacer que se quede marcado sólo "Favoritos" en el aside*/
			$(".datos_personales").removeClass("seleccionado_cliente");
			$(".pedidos_cliente").removeClass("seleccionado_cliente");
			$(".comentarios_cliente").removeClass("seleccionado_cliente");
			$(".favoritos_cliente").addClass("seleccionado_cliente");


			/*Hacer que sólo sea visible la sección de favoritos*/
			$("#datos_personales").addClass("ocultar_cliente");
			$("#pedidos_cliente").addClass("ocultar_cliente");
			$("#comentarios_cliente").addClass("ocultar_cliente");
			$("#favoritos_cliente").removeClass("ocultar_cliente");


			/*Llama a la función que obtiene los favoritos*/
			ajaxQuery("Usuario/favoritos")
			.then(function(devuelto){

				var array_favoritos=JSON.parse(devuelto);

				for (var i = 0; i < array_favoritos.length; i++) {
					
					/*Rellena el article con los productos favoritos*/
					$("#productos_favoritos_scroll").append("<article id='favorito_cliente'><a href='"+base_url+"/Productos/mostrar_producto/"+array_favoritos[i].id_producto+"'><img src='"+array_favoritos[i].imagen+"'></a><article id='informacion_favorito'><p><b>Nombre:</b> "+array_favoritos[i].nombre_producto+"</p><p><b>Descripción:</b> "+array_favoritos[i].descripcion+"</p><p><b>Composición:</b> "+array_favoritos[i].composicion+"</p><p><b>Color:</b> "+array_favoritos[i].color+"</p><p><b>Género:</b> "+array_favoritos[i].genero+"</p><p><b>Precio:</b> "+array_favoritos[i].precio+"</p></article></article>");
				}

			});
		})

	/*FIN FAVORITOS*/

});