$(document).ready(function(){
	var drop_menu=false;
	var drop_menu_admin=false;
	$(window).resize(function(){
		if($(window).width()>799){
			$(".nav_categorias").show()
			$("#aside_panel_admin").show()
		}
		else{
			$(".nav_categorias").hide()
			$("#aside_panel_admin").hide()
			drop_menu=false;
			drop_menu_admin=false;
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

	$("#drop_menu_admin").click(function(){
		drop_menu_admin=!drop_menu_admin;
		if(drop_menu_admin==true){
			$("#aside_panel_admin").show(1000)

		}
		else{
			$("#aside_panel_admin").hide(1000)
		}
	})
})