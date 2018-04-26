
$(document).ready(function(){
var base_url="http://localhost:8080/proyecto_final/";
	var objetos=JSON.parse(localStorage.getItem('productos'))
	var total=0;
	var parseint=0;
	for(var i=0; i<objetos.length; i++){
		$("#section_productos_compra").append("<article class='article_elemento_comprar'><img src='"+objetos[i]['imagen']+"'><ul><li>"+objetos[i]['nombre_producto']+"</li><li>Talla: "+objetos[i]['desc_talla']+"</li><li>"+objetos[i]['color']+"</li><li>Cantidad: "+objetos[i]['count']+"</li></ul><ul><li class='a_total_final'>Precio: "+objetos[i]['precio']+"€</li></ul></article>")
		parseint=parseInt(objetos[i]['precio']);
		total=total+parseint;

	}
		$("#section_productos_compra").append("<p class='p_total_final'>PRECIO TOTAL<a class='a_total_final'> "+total+"</a>€</p>")




 var datos_usuario = JSON.parse(localStorage.user)
// cargar perfil de compra
$("#form_compra_d_u #nc").val(datos_usuario[0].nombre);
$("#form_compra_d_u #ac").val(datos_usuario[0].apellidos);
$("#form_compra_d_u #fcc").val(datos_usuario[0].fecha_nac);
$("#form_compra_d_u #dc").val(datos_usuario[0].domicilio);
$("#form_compra_d_u #lc").val(datos_usuario[0].localidad);
$("#form_compra_d_u #pc").val(datos_usuario[0].provincia);
$("#form_compra_d_u #cc").val(datos_usuario[0].correo);
$("#form_compra_d_u #tc").val(datos_usuario[0].telefono);

$("#comprar_final").click(function(e){
//e.preventDefault();
if($("#form_compra_d_u #dnic").val().length<9 || $("#form_compra_d_u #cpc").val().length<5){
	swal("Revisa tus datos personales")
}
else if($("#credit_number").val().length<16 || $("#credit_person").val().length<8 || $("#credit_exp").val().length<5 || $("#credit_ccv").val().length<3){
	swal("Revisa tu tarjeta de credito, los datos no coinciden")
}
else{
	$.post({url: base_url+"index.php/Compra/fin_compra",
	        datatype:"json",
	  	    data:{'total':$(".a_total_final").text(),'usuario':localStorage.user,"productos":localStorage.productos},
	   	    success: function(devuelto){
	   	    	e.preventDefault()
	   
	        swal("Pedido realizado!", "En breves momentos tu pedido será empaquetado, ya te hemos mandado un correo electronico con los datos. Puedes ver su estado en tu perfil.")
			.then((value) => {
				localStorage.removeItem("productos")
		 		 location.href="Principal"
		});
	    }});
}

	
})


})
