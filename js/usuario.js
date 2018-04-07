$(document).ready(function(){


//al iniciar sesion se crean estos elementos
// localStorage.setItem("AUTH",true) //controla si estas autentificado
 var array=[{"id_usuario":2,"Nombre":"Cliente","apellidos":"ape apello","correo":"abcd@gmail.com","fecha_nacimiento":"2001-01-01","domicilio":"c/Kalea","provincia":"Bizkaia","localidad":"Bilbao"}]
 localStorage.setItem("user",JSON.stringify(array)) //aqui se guardan todos los datos del usuario
 var datos_usuario = JSON.parse(localStorage.user)


// cargar perfil usuario
$(".form_client #form_nombre_cliente").val(datos_usuario[0].Nombre);
$(".form_client #form_apellidos_cliente").val(datos_usuario[0].apellidos);
$(".form_client #form_fecha_cliente").val(datos_usuario[0].fecha_nacimiento);
$(".form_client #form_domicilio_cliente").val(datos_usuario[0].domicilio);
$(".form_client #form_localidad_cliente").val(datos_usuario[0].localidad);
$(".form_client #form_provincia_cliente").val(datos_usuario[0].provincia);
$(".form_client #form_correo_cliente").val(datos_usuario[0].correo);










$(".cerrar_sesion").click(function(){
	localStorage.removeItem("AUTH");
	localStorage.removeItem("user");
	localStorage.removeItem("productos");
	location.href='/proyecto_final/index.php/Principal'
})



});
