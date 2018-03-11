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
});