<?php

/*Este controlador es para lo siguiente:

	- 

	- 

*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion extends CI_Controller {
	 function __construct() {
	    parent::__construct();
		$this->load->helper('url');
		$this->load->model('Productos_model');
		$this->load->model('Usuario_model');
	}


	public function index()
	{
		$datos['tipos_producto']=$this->Productos_model->obtener_categorias();
		$datos['listado_completo_productos']=$this->Productos_model->obtener_productos();
		$datos['listado_completo_usuarios']=$this->Usuario_model->obtener_usuarios();
		$this->load->view('vistas_index/head');
		$this->load->view('administracion/plantilla_adm',$datos);

	}


	public function estilos(){
		echo json_encode($this->input->post("id_tipo_producto"));
	}





}
