var base_url="http://localhost:8080/proyecto_final/index.php/";



function ajaxQuery (url,jsondata){
  return new Promise(function(devolver_datos){

  	$.post({url:base_url+url,
		    datatype:"json",
	       	data:jsondata,
		    success: function(data){devolver_datos(data)}
    });
  });
}