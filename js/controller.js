



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
var base_url="/proyecto_final/";
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
	var exit=false;
	if($(".btn_activo").length){
		var id_elemento=1;
		for (var i = 0; i < productos.length; i++) {
			if(productos[i]['producto']==$(".li_referencia a").text() && productos[i]['talla']==$(".btn_activo").val()){
				productos[i]['count']=productos[i]['count']+1
				exit=true;
				$("#ver_carrito").append("<p class='nuevo_producto'>+1</p>")
				localStorage.setItem('productos',JSON.stringify(productos))
				location.reload()


			}
		}
		if(exit==false){

			if(productos.length>0){
				id_elemento=parseInt(productos[productos.length-1]['id_elemento'])+1;
			}

				ajaxQuery("Compra/carrito",{'id_producto':$(".li_referencia a").text(),'id_talla':$(".btn_activo").val(),'id_elemento':id_elemento})
				.then(function(devuelto){
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

				});

		}
	}
	else{
		swal("Selecciona una talla.")
		
	}
}


function generar_elementos_carrito(){
	$(".section_creacion_articulos .carrito_producto").remove();
	var objetos=JSON.parse(localStorage.getItem('productos'))
	var productos_totales=0;
	var precio = 0;
	for(var i=0; i<objetos.length; i++){
		productos_totales=productos_totales+objetos[i].count;
	}
	$(".section_creacion_articulos").append("<article class='cantidad_elementos_carrito'>Productos totales: "+productos_totales+"</article>")
	for(var i=0; i<objetos.length; i++){
		if(objetos[i]['precio_ant']!=0){
			 precio=objetos[i]['precio_ant']
		}
		else{
			precio=objetos[i]['precio']
		}
		console.log(precio+"njdd")
		console.log("njdd")
		$(".section_creacion_articulos").append("<article class='carrito_producto'><img src='"+objetos[i]['imagen']+"'><ul><li>"+objetos[i]['nombre_producto']+"</li><li>Talla: "+objetos[i]['desc_talla']+"</li><li>"+objetos[i]['color']+"</li><li>Cantidad:"+objetos[i]['count']+"</li><li>Precio: "+precio+"€</li></ul><ul class='ul_del_producto'><li><button type='button' class='btn_eliminar_producto' value="+objetos[i]['id_elemento']+"><i class='material-icons'>delete_forever</i></button></li></ul></article>")
	}
	carrito_precio_total();
}



$(".btn_eliminar_producto").click(function(){
	for (var i = 0; i < productos.length; i++) {
		if($(this).val()==productos[i]['id_elemento']){
			productos.splice(productos.indexOf(productos[i]),1)
		}
	}
	swal("Producto retirado del carrito.")
		.then((value) => {
		localStorage.setItem('productos',JSON.stringify(productos))
location.reload();

	});

});




function carrito_precio_total(){
	//carrito_precio_total
	var total=0;
	var parseint=0;
	var precio=0;
	for (var i = 0; i < productos.length; i++) {
		if(productos[i]['precio_ant']!=0){
			precio=productos[i]['precio_ant']
		}
		else{
			precio=productos[i]['precio']
		}
		parseint=parseInt(precio*objetos[i]['count']);
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
		swal("Pedido minimo 25€")
	}
	else{
			ajaxQuery("Compra/comprobar_stock",{"productos":localStorage.productos})
		.then(function(devuelto){
			var array=JSON.parse(devuelto);
			        if(array==0){
			 			swal("¡Perfecto!", "Te estamos redirigiendo a la plataforma de pago Online.", "success")
							.then((value) => {
								window.location.assign(base_url+"index.php/Compra")
						});
			        }
			        else{
			        	var mensaje ="";
			        	for (var i = 0; i < array.length; i++) {
			        		mensaje+="<b>Producto:</b> "+array[i]['nombre']+" <b>Talla:</b> "+array[i]['talla']+" <br><b>Quedan</b> "+array[i]['stock']+"<br>"
			        	}

						swal({
						  type: 'error',
						  title: 'Vaya...',
						  text: 'Parece que los siguientes productos no tienen suficiente stock',
						  footer: '<p>'+mensaje+'</p>',
						})
			        }

		});
	}
})

})
