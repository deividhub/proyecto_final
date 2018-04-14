$(document).ready(function(){




if(!localStorage.conexion){
	loading();
	localStorage.setItem("conexion",true)
}



$("#btn_iniciar_sesion").click(function(e){
	e.preventDefault()

	ajaxQuery("Principal/iniciar_sesion",{"correo":$("#correo_log").val(),"pass":$("#contraseña_login").val()})
	.then(function(devuelto){
		if(devuelto==1){
		swal("Usuario no encontrado")
		}
		else{
			swal("Accediendo a la plataforma.","Espera unos segundos...")
			.then((value) => {
		 		localStorage.setItem("user", devuelto)
		 		location.href ="../Principal";

		});
		}
		

	});
})



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





/*PAGINATION*/
var comentarios=[{"pagination":"1","usuario":"Nerea Lopez","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."}]
comentarios.push({"pagination":"1","usuario":"Nerea Lopez","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
comentarios.push({"pagination":"1","usuario":"Nerea Lopez","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
comentarios.push({"pagination":"1","usuario":"Nerea Lopez","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
comentarios.push({"pagination":"1","usuario":"Nerea Lopez","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
comentarios.push({"pagination":"1","usuario":"Sexto Lopez","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
comentarios.push({"pagination":"2","usuario":"Manolo Lama","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
comentarios.push({"pagination":"2","usuario":"Manolo Lama","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
comentarios.push({"pagination":"2","usuario":"Manolo Lama","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
comentarios.push({"pagination":"2","usuario":"Manolo Lama","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
comentarios.push({"pagination":"2","usuario":"Manolo Lama","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
comentarios.push({"pagination":"2","usuario":"Manolo Lama","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
comentarios.push({"pagination":"2","usuario":"Manolo Lama","fecha":"2018-03-29 16:44:23","texto":"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et."})
localStorage.setItem("comentarios",JSON.stringify(comentarios))
var coment=JSON.parse(localStorage.comentarios);

if(localStorage.comentarios){
	$("#pagination").append("<ul></ul>")
	$("#pagination ul").append("<li><a href='#' class='active'>1</a></li>")
	var paginaciones=coment[coment.length-1].pagination
	for (var i = 0; i < paginaciones-1; i++) {
		$("#pagination ul").append("<li><a href='#'>"+parseInt(i+1+1)+"</a></li>")
	};
	for (var i = 0; i < coment.length; i++) { 
		if(coment[i].pagination!=1){
			break;
		}
		$("#article_comentarios").append("<article class='comentario_usuario'><ul class='comentario_datos_usuario'><li>"+coment[i].usuario+"</li><li>"+coment[i].fecha+"</li><li>"+coment[i].texto+"</li></ul></article>")
	};
}

$("#pagination ul li a").click(function(e){
	e.preventDefault();

	$(".comentario_usuario").remove()//vaciar comentarios

	$("#pagination ul li a").removeClass('active')//quitar la clase a los enlaces de paginacion

	$(this).addClass('active')//darle esa clase al clickado para que coja el color
	for (var i = ($(this).text()-1)*6; i < coment.length; i++) { 
		//numero clickado de paginacion menos 1 * elementos a aparecer
		// esto hara que al hacer click en un elemento de paginacion te mostrara los 6 elementos que tengan esa paginacion.
		if(coment[i].pagination!=$(this).text()){

			break;

		}

	$("#article_comentarios").append("<article class='comentario_usuario'><ul class='comentario_datos_usuario'><li>"+coment[i].usuario+"</li><li>"+coment[i].fecha+"</li><li>"+coment[i].texto+"</li></ul></article>")
	
	};

})


/* FIN PAGINATION*/





/*Comentar producto*/


$("#btn_comentar").click(function(){
	ajaxQuery("productos/comentar",{"id_producto":$(".li_referencia a").text(),"comentario":$("#txt_comentario").val()})
	.then(function(devuelto){
		//setInterval(location.reload(), 2000);
		swal("¡Has comentado este producto!", "¡Es importante tu opinión!")
			.then((value) => {
		  		location.reload();
		});

	});
})

if (!localStorage.user) {
	$(".no-coment").text("No puedes comentar, no has iniciado sesión.")
}
else{
	$(".no-coment").text("No puedes comentar, ya has comentado este producto.")

}

});
