
$(document).ready(function(){
var base_url="http://localhost:8080/proyecto_final/";
	var objetos=JSON.parse(localStorage.getItem('productos'))
	var total=0;
	var parseint=0;
	var envio=7.99;
	var ahorrado=0;

	for(var i=0; i<objetos.length; i++){
		if(objetos[i]['precio_ant']!=0){
			precio=objetos[i]['precio_ant']
			ahorrado=ahorrado+(objetos[i]['precio']-objetos[i]['precio_ant']);
		}
		else{
			precio=objetos[i]['precio']
		}
		parseint=parseInt(precio*objetos[i]['count']);
		$("#section_productos_compra").append("<article class='article_elemento_comprar'><img src='"+objetos[i]['imagen']+"'><ul><li>"+objetos[i]['nombre_producto']+"</li><li>Talla: "+objetos[i]['desc_talla']+"</li><li>"+objetos[i]['color']+"</li><li>Cantidad: "+objetos[i]['count']+"</li></ul><ul><li class='a_total_final'>Precio: "+precio+"€</li></ul></article>")
		parseint=parseInt(precio*objetos[i]['count']);
		total=total+parseint;

	}	

	$("#section_productos_compra").append("<p class='p_envio'>Subtotal: "+total+" €</p>")

	if(total<40){
		total=total+envio;
		envio = "7.99 €"
	}
	else{
		envio="Gratuito";
	}

	$("#section_productos_compra").append("<p class='p_envio'>Envio: "+envio+"</p>")

	$("#section_productos_compra").append("<p class='p_total_final'>Precio total: <a class='a_total_final a_final_precio'> "+total+"</a>€   </p>")
	if(ahorrado!=0){
		$("#section_productos_compra").append("<p class='p_envio'>*Te ahorras: "+ahorrado+"€</p>")

	}





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




// cuando clickas para comprar
$(".comprar_final").click(function(){

	if($(".a_final_precio").text()<25){
		swal({
		  type: 'error',
		  title: 'Oops...',
		  text: 'Tu carrito está vacio o no cumple el precio mínimo que son 25€',
		})
	}

	else if($("#form_compra_d_u #dnic").val().length<9 || $("#form_compra_d_u #dnic").val().length>9 || $("#form_compra_d_u #cpc").val().length<5 || $("#form_compra_d_u #cpc").val().length>5){
		swal("Revisa tus datos personales")
	}

	else if($("#credit_number").val().length<16|| $("#credit_number").val().length>16 || $("#credit_person").val().length<8 || $("#credit_exp").val().length<5 || $("#credit_exp").val().length>5 || $("#credit_ccv").val().length<3 || $("#credit_ccv").val().length>3){
		swal("Revisa tu tarjeta de credito, los datos no coinciden")
	}
	else if($("#acept_terms:checked").length==0){
		swal("Acepta los terminos y condiciones");
	}

	else{
		var xhr = new XMLHttpRequest();
	    xhr.open('POST', base_url+'index.php/Compra/fin_compra', true);
	    xhr.responseType = 'blob';
		xhr.setRequestHeader("Content-type", "application/json")

	    xhr.onload = function(e) {
	      if (this.status == 200) {
	        var blob = new Blob([this.response], {type: 'application/pdf'});
	        var link = document.createElement('a');
	        link.href = window.URL.createObjectURL(blob);
	        link.download = "detalles_pedido.pdf";
	        link.click();    
	        swal("Pedido realizado!", "En breves momentos tu pedido será empaquetado, ya te hemos mandado un correo electronico con los datos. Puedes ver su estado en tu perfil y también te hemos generado un documento con datos sobre tu pedido mira en tu carpeta de descargas.")
				.then((value) => {
					//localStorage.removeItem("productos")

			 		//location.href="Principal"

			});   
	      }
	    };
		xhr.send(JSON.stringify({'total':$(".a_final_precio").text(),'usuario':localStorage.user,"productos":localStorage.productos})); 
	
		/*$.post({url: base_url+"index.php/Compra/fin_compra",
		        datatype:"json",
		  	    data:{'total':$(".a_final_precio").text(),'usuario':localStorage.user,"productos":localStorage.productos},
		   	    success: function(devuelto){
		        swal("Pedido realizado!", "En breves momentos tu pedido será empaquetado, ya te hemos mandado un correo electronico con los datos. Puedes ver su estado en tu perfil y también te hemos generado un documento con datos sobre tu pedido mira en tu carpeta de descargas.")
				.then((value) => {
					//localStorage.removeItem("productos")

			 		//location.href="Principal"

				});
		}});*/
	}

	
})


})
