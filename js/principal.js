$(document).ready(function(){

if(!localStorage.conexion){
	loading();
	localStorage.setItem("conexion",true)
}
function loading(){
	$("body").append("<p class='loading'><i class='material-icons'>remove_from_queue</i><a>Cargando</a></p>")
	$("body").css("background","#e2dccf")
	$("section").css("visibility","hidden")
	$("footer").css("visibility","hidden")
	$("header").css("visibility","hidden")
	$("nav").css("visibility","hidden")
	var myVar = setInterval(myTimer, 6000);
}

function myTimer() {
	$("section").css("visibility","visible")
	$("footer").css("visibility","visible")
	$("header").css("visibility","visible")
	$("nav").css("visibility","visible")
	$("body").css("background","transparent")
	$("body .loading").remove()
}



var visible = false;
// función de mostrar comentario
$("#section_desplegar_comentario").click(function(){


	if(visible == false)
	{
		$("#section_comentarios").slideDown('slow');
		$("#section_comentarios").css('display','flex');
		$("#section_desplegar_comentario h1").addClass('desplegado');
		visible = true;
	}


	else 
	{
		$("#section_comentarios").slideUp('slow');
		$("#section_desplegar_comentario h1").removeClass('desplegado');
		visible = false;
	}
})


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
 var array=[{"id_usuario":2,"Nombre":"Cliente"}]
 localStorage.setItem("user",JSON.stringify(array)) //aqui se guardan todos los datos del usuario
$(".cerrar_sesion").click(function(){
	localStorage.removeItem("AUTH");
	localStorage.removeItem("user");
	localStorage.removeItem("productos");
	location.href='/proyecto_final/index.php/Principal'
})














// funcion favoritos
$("#icono_fav.fav-false").click(function(){
	ajaxQuery("productos/favorito",{"id_producto":$(".li_referencia a").text(),"estado":false})
	.then(function(devuelto){
		//setInterval(location.reload(), 2000);
		swal("¿Te gusta este producto verdad?", "¡Producto añadido a favoritos!")
			.then((value) => {
		 		 location.reload();
		});

	});
})

$("#icono_fav.fav-true").click(function(){
	ajaxQuery("productos/favorito",{"id_producto":$(".li_referencia a").text(),"estado":true})
	.then(function(devuelto){
		//setInterval(location.reload(), 2000);
		swal("¿Ya no te gusta este producto?", "¡Producto eliminado de favoritos!")
			.then((value) => {
		  		location.reload();
		});

	});
})



});