$(document).ready(function(){




if(!localStorage.conexion){
	loading();
	localStorage.setItem("conexion",true)
}
ajaxQuery("Principal/registrado")
.then(function(devuelto){
	if(devuelto=="true"){
	swal("Bienvenido, ahora inicia sesion")
	swal({
	  title: '¡Bienvenido a nuestra tienda!, ahora inicia sesión',
	  animation: false,
	  customClass: 'animated tada'
	})
	}
});
if(sessionStorage.getItem("primeravez")==null){
     sessionStorage.setItem("primeravez",true);
		swal({
	  	  title: "!Bienvenido¡",
		  type: 'info',
		  html: "¿Aún no te has registrado? ¡Hazlo rápidamente ahora!",
		  showCloseButton: true,
		  showCancelButton: true,
		  focusConfirm: false,
		  confirmButtonText:
		    '<i class="fa fa-thumbs-up"></i> Registrar',
		  confirmButtonAriaLabel: 'Thumbs up, great!',
		  cancelButtonText:
		  '<i class="fa fa-thumbs-down"></i> Mejor después',
		  cancelButtonAriaLabel: 'Thumbs down',
		}).then((result) => {
		  if(result.value==true){
		  	location.href=base_url+"Principal/login_registro"
		  }
		})
 }


$("#btn_iniciar_sesion").click(function(e){
	e.preventDefault()

	ajaxQuery("Principal/iniciar_sesion",{"correo":$("#correo_log").val(),"pass":$("#contraseña_login").val()})
	.then(function(devuelto){
		if(devuelto==1){
		swal("Usuario no encontrado")
		}
		else{
		 		localStorage.setItem("user", devuelto)
		 		location.href ="../Principal";
		}
	});
})



function loading(){
	$("body").append("<p class='loading'><i class='material-icons'>remove_from_queue</i><a>Cargando</a></p>")
	var myVar = setInterval(myTimer, 6000);
}

function myTimer() {
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
	location.href=base_url+"Productos/hombre";
})
$(".mujer").click(function(){
	location.href=base_url+"Productos/mujer";
})












// funcion favoritos
$("#icono_fav.fav-false").click(function(){
	if(localStorage.user){
	ajaxQuery("productos/favorito",{"id_producto":$(".li_referencia a").text(),"estado":false})
	.then(function(devuelto){
		//setInterval(location.reload(), 2000);
		swal("¿Te gusta este producto verdad?", "¡Producto añadido a favoritos!")
			.then((value) => {
		 		 location.reload();
		});

	});
	}
	else{
		swal("¡Registrate y podras elegir productos favoritos!")
	}
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
if($(".li_referencia a").text().length>0){
	var comentPromise=ajaxQuery("productos/obtener_comentarios_producto",{"id_producto":$(".li_referencia a").text()})
			.then(function(devuelto){
				var array=JSON.parse(devuelto);
				var paginationNumber=1;
				var contador=0;
				var salir=false;
				for (var i = 0; i < array.length; i++) {
					array[i].pagination=paginationNumber
					if(contador==5){
						paginationNumber++;
						contador=0;
						salir=true;
					}
					if(salir==false){
						contador++;
					}
					else{
						salir=false;
					}
				};
				return array
				//localStorage.setItem("comentarios",JSON.stringify(array))
	});
	//var coment=JSON.parse(localStorage.comentarios);
	comentPromise.then(function(coment){
			$("#pagination").append("<ul></ul>")
			if(coment.length==0){
				$("#pagination ul").append("<li><a href='#'>¡Se el primero en comentar!</a></li>")
			}
			else{
			$("#pagination ul").append("<li><a href='#' class='active'>1</a></li>")
			var paginaciones=coment[coment.length-1].pagination
			for (var i = 0; i < paginaciones-1; i++) {
				$("#pagination ul").append("<li><a href='#'>"+parseInt(i+1+1)+"</a></li>")
			};
			for (var i = 0; i < coment.length; i++) { 
				if(coment[i].pagination!=1){
					break;
				}
				$("#article_comentarios").append("<article class='comentario_usuario'><ul class='comentario_datos_usuario'><li>"+coment[i].nombre+"</li><li>"+coment[i].fecha+"</li><li>"+coment[i].descripcion+"</li></ul></article>")
			}
		}
	})



		
	
}


$(document).on("click", "#pagination ul li a", function(e){
    e.preventDefault()
    var textoPagination=$(this).text();
    $(".comentario_usuario").remove()//vaciar comentarios
		$("#pagination ul li a").removeClass('active')//quitar la clase a los enlaces de paginacion
		$(this).addClass('active')//darle esa clase al clickado para que coja el color
	comentPromise.then(function(coment){
		
		for (var i = (textoPagination-1)*6; i < coment.length; i++) { 
			//numero clickado de paginacion menos 1 * elementos a aparecer
			// esto hara que al hacer click en un elemento de paginacion te mostrara los 6 elementos que tengan esa paginacion.
					console.log()
			if(coment[i].pagination!=textoPagination){
				break;
			}

			$("#article_comentarios").append("<article class='comentario_usuario'><ul class='comentario_datos_usuario'><li>"+coment[i].nombre+"</li><li>"+coment[i].fecha+"</li><li>"+coment[i].descripcion+"</li></ul></article>")
			
		};
	})
});

	


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
	$(".no-coment").text("Compra este producto para poder comentar")

}

});


