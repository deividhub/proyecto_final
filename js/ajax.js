

var base_url="http://localhost:8080/proyecto_final/index.php/";



function ajaxQuery (url,jsondata){
  return new Promise(function(devolver_datos){

  	$.post({url:base_url+url,
		    datatype:"json",
	       	data:jsondata,
   			beforeSend: function(x) {
				$("body").append("<div class='spinnerDiv'><img src='"+base_url+"../img/spinner.gif' class='spinner'><div>")
	     		$("header").css("opacity","0.5")
	     		$("nav").css("opacity","0.5")
	     		$("section").css("opacity","0.5")
	     		$("footer").css("opacity","0.5")
	     	},
		    success: function(data){devolver_datos(data)
		    $("body .spinnerDiv").remove()
	    	$("header").css("opacity","1")
	 		$("nav").css("opacity","1")
	 		$("section").css("opacity","1")
	 		$("footer").css("opacity","1")
}
    });
  });
}
