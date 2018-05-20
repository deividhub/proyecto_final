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
}











$("#recuperar_pass").click(function(e){
swal("Introduce tu correo electronico:", {
  content: "input",
})
.then((value) => {
	  ajaxQuery("Principal/recuperar_pass",{"correo":value})
		.then(function(devuelto){
			alert(devuelto+"  usuario.js linea 47 borrar")
			if(devuelto==1){

				swal("Lo sentimos, este usuario parece no estar registrado.")
			}
			else{
			 	swal("¡Perfecto!","Revisa tu bandeja de entrada, te hemos enviado un correo de recuperacion de contraseña","success")
			}
			

		});
	});
});



$(".cerrar_sesion").click(function(){

	swal("¡Hasta pronto!","Sesión cerrada","success")
	.then((value) => {
		localStorage.removeItem("user");
		localStorage.removeItem("productos");
		location.href='/proyecto_final/index.php/Principal/cerrar_sesion'
		// Hay que borrar la sesion de codeigniter
	});
})








});
