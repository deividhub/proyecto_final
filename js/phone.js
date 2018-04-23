$(document).ready(function(){
	var drop_menu=false;
	$(window).resize(function(){
		if($(window).width()>799){
			$(".nav_categorias").show()
		}
		else{
			$(".nav_categorias").hide()
			drop_menu=false;

		}

	})

	$("#drop_menu").click(function(){
		drop_menu=!drop_menu;
		if(drop_menu==true){
			$(".nav_categorias").show(1000)

		}
		else{
			$(".nav_categorias").hide(1000)
		}
	})
})