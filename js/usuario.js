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


		/*----------*/


		/*Carga los datos del usuario y su provincia*/
		ajaxQuery("Principal/cargar_provincias")
			.then(function(devuelto){
				$("#provincia_registro").append("<option value='abc'>Selecciona una provincia</option>")
				var array=JSON.parse(devuelto)
				for (var i = 0; i < array.length; i++) {
					$("#form_provincia_cliente").append("<option value="+array[i].id+">"+array[i].provincia+"</option>")
					$("#provincia_registro").append("<option value="+array[i].id+">"+array[i].provincia+"</option>")
					if(localStorage.user){

						var datos_usuario = JSON.parse(localStorage.user)
						// cargar perfil usuario
						$(".form_client #form_nombre_cliente").val(datos_usuario[0].nombre);
						$(".form_client #form_apellidos_cliente").val(datos_usuario[0].apellidos);
						$(".form_client #form_fecha_cliente").val(datos_usuario[0].fecha_nac);
						$(".form_client #form_domicilio_cliente").val(datos_usuario[0].domicilio);
						$(".form_client #form_correo_cliente").val(datos_usuario[0].correo);
						$(".form_client #form_telefono_cliente").val(datos_usuario[0].telefono);
						$(".form_client #id_usuario").val(datos_usuario[0].id_usuario);
						document.getElementById("form_provincia_cliente").value = datos_usuario[0].provincia;
					}
				}
				carga_localidades();

		});


		/*----------*/


		/*AL CAMBIAR PROVINCIA DATOS USUARIO*/
		$("#form_provincia_cliente").change(function(){
									var datos_usuario = JSON.parse(localStorage.user)

			 ajaxQuery("Principal/cargar_localidades",{"provincia":$("#form_provincia_cliente").val()})
			.then(function(devuelto){
				$("#form_localidad_cliente").empty()
				var array=JSON.parse(devuelto)
				for (var i = 0; i < array.length; i++) {
					$("#form_localidad_cliente").append("<option value="+array[i].id+">"+array[i].municipio+"</option>")
				}
				

			});		
		})

		/*AL CAMBIAR PROVINCIA REGISTRO*/
		$("#provincia_registro").change(function(){

			 ajaxQuery("Principal/cargar_localidades",{"provincia":$("#provincia_registro").val()})
			.then(function(devuelto){
				$("#localidad_registro").empty()
				var array=JSON.parse(devuelto)
				for (var i = 0; i < array.length; i++) {
					$("#localidad_registro").append("<option value="+array[i].id+">"+array[i].municipio+"</option>")
				}
				

			});		
		})

		/*----------*/


		/*Carga las localidades de la provincia elegida*/
		function carga_localidades(){
			if(localStorage.user){
									var datos_usuario = JSON.parse(localStorage.user)

			 ajaxQuery("Principal/cargar_localidades",{"provincia":$("#form_provincia_cliente").val()})
			.then(function(devuelto){
				$("#form_localidad_cliente").empty()
				var array=JSON.parse(devuelto)
				for (var i = 0; i < array.length; i++) {
					$("#form_localidad_cliente").append("<option value="+array[i].id+">"+array[i].municipio+"</option>")
				}
				
				document.getElementById("form_localidad_cliente").value = datos_usuario[0].localidad;

			});	
			}
			
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
			if(!localStorage.user){
				ajaxQuery("Principal/cerrar_sesion")
				.then(function(devuelto){
					if(sessionStorage.getItem("primeravez")==null && !sessionStorage.conexion){

						 sessionStorage.setItem("conexion",true)
					     sessionStorage.setItem("primeravez",true);

					     if(window.location.pathname != "/proyecto_final/index.php/Administracion/iniciar_sesion"){
							swal({
						  	  title: "!Bienvenido¡",
							  type: 'info',
							  html: "¿Aún no te has registrado? ¡Hazlo rápidamente ahora!",
							  showCloseButton: true,
							  showCancelButton: true,
							  focusConfirm: false,
							  confirmButtonText:
							    '<i class="fa fa-thumbs-up"></i> Registrar',
							  confirmButtonAriaLabel: 'Thumbs up, great!',
							  cancelButtonText:
							  '<i class="fa fa-thumbs-down"></i> Mejor después',
							  cancelButtonAriaLabel: 'Thumbs down',
							}).then((result) => {
							  if(result.value==true){
							  	location.href=base_url+"Principal/login_registro"
							  }
							})
						}
					 }
				});
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

			$(".datos_personales").click(function(e){
				e.preventDefault()

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

				var x = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/i;
			    if(!x.test(datos_usuario[6].value)){
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

					ajaxQuery("Usuario/guardar_datos",{"nombre":json[0].value,"apellidos":json[1].value,"fecha_nac":json[2].value,"domicilio":json[3].value,"provincia":json[4].value,"localidad":json[5].value,"correo":json[6].value,"telefono":json[7].value,"id_usuario":json[8].value})
					.then(function(devuelto){
						swal({
						  position: 'top-end',
						  type: 'success',
						  title: 'Datos modificados',
						  showConfirmButton: false,
						  timer: 1500
						})	

						ajaxQuery("Usuario/obtener_datos")
						.then(function(datos_actualizados){
								 	localStorage.setItem("user", datos_actualizados);
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

		$(".pedidos_cliente").click(function(e){
			e.preventDefault()

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
				$("#pedido_cliente_tabla .nueva").remove();
				for (var i = 0; i < array_pedidos.length; i++) {

					/*Rellena el article con los pedidos*/
					$("#pedido_cliente_tabla tbody").append("<tr class='nueva'><td>"+array_pedidos[i].id_pedido+"</td><td>"+array_pedidos[i].fecha_pedido+"</td><td>"+array_pedidos[i].desc_estado+"</td><td>"+array_pedidos[i].precio_total+"</td><td><button class='btn_tabla_pedidos' value="+array_pedidos[i].id_pedido+">Detalles...</button></td></tr>");

				}
			});
		})


		/*----------*/


		$(document).on("click",".btn_tabla_pedidos",function(){
				


			var numero = this.value
			ajaxQuery("Usuario/productos_del_pedido",{"id_pedido":this.value})

			.then(function(devuelto){

				var array_productos=JSON.parse(devuelto);
				$("body").append("<article id='productos_pedido_cliente'></article>")
				$("#productos_pedido_cliente").append("<article id='productos_pedido_cliente3'></article>")
				$("#productos_pedido_cliente3").append("<button id='cerrar_detalles'>X</button>")
				$("#productos_pedido_cliente3").append("<h1>Estos son los detalles de tu pedido nº "+numero+"</h1>")
				$("#productos_pedido_cliente3").append("<article id='productos_dentro'></article>")

				for (var i = 0; i < array_productos.length; i++) {

					$("#productos_dentro").append("<article id='productos_pedido_cliente2'><a href='"+base_url+"/Productos/mostrar_producto/"+array_productos[i].id_producto+"'><img src='"+array_productos[i].imagen+"'></a><article id='informacion_pedido'><p><b>Nombre: </b>"+array_productos[i].nombre_producto+"</p><p><b>Cantidad: </b>"+array_productos[i].cantidad+"</p><p><b>Precio: </b>"+array_productos[i].precio+" €</p></article></article>")
										
				}
			});
		})


		$(document).on("click","#cerrar_detalles",function(){

			$("#productos_pedido_cliente").remove();
		})

	/*FIN PEDIDOS*/


	/*--------------------*/


	/*FAVORITOS*/

		$(".favoritos_cliente").click(function(e){
			e.preventDefault()

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
				$("#productos_favoritos_scroll #favorito_cliente").remove()
				for (var i = 0; i < array_favoritos.length; i++) {
					
					/*Rellena el article con los productos favoritos*/
					$("#productos_favoritos_scroll").append("<article id='favorito_cliente'><a href='"+base_url+"/Productos/mostrar_producto/"+array_favoritos[i].id_producto+"'><img src='"+array_favoritos[i].imagen+"'></a><article id='informacion_favorito'><p><b>Nombre:</b> "+array_favoritos[i].nombre_producto+"</p><p><b>Descripción:</b> "+array_favoritos[i].descripcion+"</p><p><b>Composición:</b> "+array_favoritos[i].composicion+"</p><p><b>Color:</b> "+array_favoritos[i].color+"</p><p><b>Género:</b> "+array_favoritos[i].genero+"</p><p><b>Precio:</b> "+array_favoritos[i].precio+"</p></article></article>");
				}

			});
		})

	/*FIN FAVORITOS*/

});