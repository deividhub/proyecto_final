



// FUNCION DEL CARRITO
	/*
	1- comprobar si esta creada la variable productos de localstorage
		1.1- si esta creada, creamos el array de productos y le añadimos el contenido de la variable de localstorage
		se llama a la funcion generar_elementos_carrito() que es la que se encarga de crear los elementos

		1.2- si no, creamos el array productos y informamos que el carrito esta vacio.

	2- al hacer click se mete en el array unos valores.
		los valores se pasan a la variable local
		se eliminan de carrito todos los elementos y despues se llama a la funcion para que los genere.




	*/


$(document).ready(function(){
var base_url="http://localhost:8080/proyecto_final/";
var carrito_vacio="<p class='carrito_sin_productos'>El carrito está vacio, recuerda que para realizar una compra debes iniciar sesion si no lo has hecho todavía.</p>"
$("#btn_añadir_carrito").click(añadir_elemento);


if(localStorage.productos){
	var productos=[];
	var objetos=JSON.parse(localStorage.getItem('productos'))
	if(objetos.length==0){
		$("#ul_carrito_total").css("display","none");
		$("#carrito").append(carrito_vacio);

	}
	else{
		for(var i=0; i<objetos.length; i++){
			productos.push(objetos[i])
		}
		generar_elementos_carrito();
	}
}
else{
	var productos = [];
	$("#ul_carrito_total").css("display","none");
	$("#carrito").append(carrito_vacio);

}






function añadir_elemento(){
	if($(".btn_activo").length){
		var id_elemento=1;
		if(productos.length>0){
		id_elemento=parseInt(productos[productos.length-1]['id_elemento'])+1;
		}



		$.post({url: base_url+"index.php/Compra/carrito",
	        datatype:"json",
	        data:{'id_producto':$(".li_referencia a").text(),'id_talla':$(".btn_activo").val(),'id_elemento':id_elemento},
	        success: function(devuelto){

	        var array=JSON.parse(devuelto);
	 		productos.push(array);
			localStorage.setItem('productos',JSON.stringify(productos))
			var objeto=JSON.parse(localStorage.getItem('productos'))
			$(".section_creacion_articulos article").remove();
			$("#ul_carrito_total").show();
			$(".carrito_sin_productos").css("display","none");
			location.reload();
				$("#ver_carrito").append("<p class='nuevo_producto'>+1</p>")

			generar_elementos_carrito();



	    }});
	}
	else{
		alert("Selecciona una talla.")
		
	}
}


function generar_elementos_carrito(){
	$(".section_creacion_articulos .carrito_producto").remove();
	var objetos=JSON.parse(localStorage.getItem('productos'))
	$(".section_creacion_articulos").append("<article class='cantidad_elementos_carrito'>Productos totales: "+productos.length+"</article>")
	for(var i=0; i<objetos.length; i++){
		$(".section_creacion_articulos").append("<article class='carrito_producto'><img src='"+objetos[i]['imagen']+"'><ul><li>"+objetos[i]['nombre_producto']+"</li><li>Precio: "+objetos[i]['precio']+"€</li><li>Talla: "+objetos[i]['desc_talla']+"</li><li>"+objetos[i]['color']+"</li><li><button type='button' class='btn_eliminar_producto' value="+objetos[i]['id_elemento']+">Eliminar</button></li></ul></article>")
	}
	carrito_precio_total();
}



$(".btn_eliminar_producto").click(function(){
	for (var i = 0; i < productos.length; i++) {
		if($(this).val()==productos[i]['id_elemento']){
			productos.splice(productos.indexOf(productos[i]),1)
			alert("Producto retirado del carrito.")
		}
	}
		localStorage.setItem('productos',JSON.stringify(productos))
location.reload();

});




function carrito_precio_total(){
	//carrito_precio_total
	var total=0;
	var parseint=0;
	for (var i = 0; i < productos.length; i++) {
		parseint=parseInt(productos[i]['precio']);
		total=total+parseint;
	}
	$("#carrito_precio_total").text(total)
}



// funcion que le da una clase al boton de la talla para saber que talla se ha elegido
$(".btn_talla").click(function(){
	$(".btn_talla").removeClass("btn_activo");
	$(this).addClass("btn_activo");
})



$("#btn_pasar_a_caja").click(function(){
	if($("#carrito_precio_total").text()<25){
		alert("Pedido minimo 25€")
	}
	else{
		window.location.assign(base_url+"Index.php/Compra")
	}
})


})
