<?php

/*Este controlador es para lo siguiente:

	- Cargará principalmente la pagina principal.
	- Al darle a iniciar sesion/registro se ejecutará la funcion "formulario_sesion_registro", la cual carga la vista de dos formularios para registrar o iniciar sesion.

	- al rellenar el formulario de iniciar sesion y darle al boton se ejecutará la función "iniciar_sesion" y en caso de darle a registrar la de "registrar".

*/



defined('BASEPATH') OR exit('No direct script access allowed');

// sesion y database ya estan puestos en autoload!!!!!
class Principal extends CI_Controller {
	 function __construct() {
	    parent::__construct();
		$this->load->helper('url');
		$this->load->model('Principal_model');
		$this->load->model('Productos_model');

	}


	public function index()
	{
		//obtener categorias y estilos.
		$datos['categorias']=$this->Productos_model->obtener_categorias();
		$datos['estilos']=$this->Productos_model->obtener_estilos();

		$this->load->view('vistas_index/head');

		//if ($this->session->userdata('AUTHENTIFIED')) {
			$this->load->view('logueado/header_logueado');
		//}
		//else{
		//	$this->load->view('vistas_index/header');
		//}
		$this->load->view('vistas_index/navegacion',$datos);
		$this->load->view('vistas_index/principal');
		$this->load->view('vistas_index/footer');
	}


	public function formulario_sesion_registro(){
		
	}

	public function iniciar_sesion(){
		// devuelve 2 tipos de datos: redireccion al logueado o error al iniciar sesion.
		// utilizar md5
		$this->load->view('vistas_index/head');
		$this->load->view('logueado/header_logueado');
		$this->load->view('vistas_login/login_client');
		$this->load->view('vistas_index/footer');

	}



	public function registro(){
		$this->load->view('vistas_index/head');
		$this->load->view('registro');		
	}



	public function perfil_usuario(){
		$this->load->view('vistas_index/head');
		$this->load->view('administracion/plantilla_client');
	}
}
