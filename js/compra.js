
$(document).ready(function(){
var base_url="http://localhost:8080/proyecto_final/";
	var objetos=JSON.parse(localStorage.getItem('productos'))
	var total=0;
	var parseint=0;
	for(var i=0; i<objetos.length; i++){
		$("#section_productos_compra").append("<article class='article_elemento_comprar'><img src='"+objetos[i]['imagen']+"'><ul><li>"+objetos[i]['nombre_producto']+"</li><li>Precio: "+objetos[i]['precio']+"€</li><li>Talla: "+objetos[i]['desc_talla']+"</li><li>"+objetos[i]['color']+"</li></ul></article>")
		parseint=parseInt(objetos[i]['precio']);
		total=total+parseint;

	}
		$("#section_productos_compra").append("<p class='p_total_final'>PRECIO TOTAL<a class='a_total_final'> "+total+"</a>€</p>")




$("#comprar_final").click(function(e){
e.preventDefault();


		$.post({url: base_url+"index.php/Compra/fin_compra",
	        datatype:"json",
	        data:{'total':$(".a_total_final").text(),'id_usuario':2,"productos":localStorage.productos},
	        success: function(devuelto){
	        	alert(JSON.parse(devuelto))

	        //var array=JSON.parse(devuelto);
	    }});
})


})
