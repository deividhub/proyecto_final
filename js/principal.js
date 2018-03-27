$(document).ready(function(){

// al hacer click en hombre y mujer
$(".hombre").click(function(){
	$(this).addClass("li_activo")
	$(".mujer").removeClass("li_activo")
})
$(".mujer").click(function(){
	$(this).addClass("li_activo")
	$(".hombre").removeClass("li_activo")
})



//al iniciar sesion se crean estos elementos
// localStorage.setItem("AUTH",true) //controla si estas autentificado
// localStorage.setItem("user",{"as":"as"}) //aqui se guardan todos los datos del usuario



$(".cerrar_sesion").click(function(){
	localStorage.removeItem("AUTH");
	localStorage.removeItem("user");
	location.href='/proyecto_final/index.php/Principal'
})

});