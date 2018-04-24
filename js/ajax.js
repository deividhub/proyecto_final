

var base_url="http://localhost:8080/proyecto_final/index.php/";



function ajaxQuery (url,jsondata){
  return new Promise(function(devolver_datos){

  	$.post({url:base_url+url,
		    datatype:"json",
	       	data:jsondata,
   			beforeSend: function(x) {
				$("body").append("<div class='spinnerDiv'><div class='spinner-container'><p>Espere, cargando solicitud</p><p class='spinner'></p></div><div>")
	     	},
		    success: function(data){devolver_datos(data)
		    $("body .spinnerDiv").remove()
}
    });
  });
}