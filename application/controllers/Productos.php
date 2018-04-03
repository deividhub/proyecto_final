<?php

/*Este controlador es para lo siguiente:

	- Cargará principalmente una vista con los productos que se hayan seleccionado en la principal.

	- al darle a un producto, llamará a la funcion "mostrar_producto" y mediante el segmento se mostrara toda la informacion relacionada con ese elemento.

*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	 function __construct() {
	    parent::__construct();
		$this->load->helper('url');
		$this->load->model('Productos_model');
	}

	public function index()
	{
		$datos['categorias']=$this->Productos_model->obtener_categorias();
		$datos['estilos']=$this->Productos_model->obtener_estilos();
		$datos['productos']=$this->Productos_model->obtener_productos();

		$this->load->view('vistas_index/head');
		$this->load->view('logueado/header_logueado');
		$this->load->view('vistas_index/navegacion',$datos);
		$this->load->view('productos/vista_productos',$datos);
		$this->load->view('vistas_index/footer');
	}



	// es para mostrar todos los productos segun el tipo que se haya escogido.
	public function mostrar_productos_tipo(){
		$datos['categorias']=$this->Productos_model->obtener_categorias();
		$datos['estilos']=$this->Productos_model->obtener_estilos();


		
		$id_tipo_producto=$this->uri->segment(3);
		$datos['productos']=$this->Productos_model->obtener_productos_tipo($id_tipo_producto);

		$this->load->view('vistas_index/head');
		$this->load->view('logueado/header_logueado');
		$this->load->view('vistas_index/navegacion',$datos);
		$this->load->view('productos/vista_productos',$datos);
		$this->load->view('vistas_index/footer');
	}

	// es para mostrar todos los productos segun el estilo que se haya escogido.
	public function mostrar_productos_estilo(){
		$datos['categorias']=$this->Productos_model->obtener_categorias();
		$datos['estilos']=$this->Productos_model->obtener_estilos();


		
		$id_estilo=$this->uri->segment(3);
		$datos['productos']=$this->Productos_model->obtener_productos_estilo($id_estilo);

		$this->load->view('vistas_index/head');
		$this->load->view('logueado/header_logueado');
		$this->load->view('vistas_index/navegacion',$datos);
		$this->load->view('productos/vista_productos',$datos);
		$this->load->view('vistas_index/footer');
	}


	public function mostrar_producto(){
		$datos['categorias']=$this->Productos_model->obtener_categorias();
		$datos['estilos']=$this->Productos_model->obtener_estilos();


		//select para obtener ese producto
		$id_producto=$this->uri->segment(3);
		$datos['producto']=$this->Productos_model->obtener_producto($id_producto);
		$datos['tallas']=$this->Productos_model->obtener_tallas_producto($id_producto);
		$datos['favoritos']=$this->Productos_model->obtener_favoritos($id_producto);

		$this->load->view('vistas_index/head');
		$this->load->view('logueado/header_logueado');
		$this->load->view('vistas_index/navegacion',$datos);
		$this->load->view('productos/vista_producto',$datos);
		$this->load->view('vistas_index/footer');
	}


	public function favorito(){
		$this->Productos_model->favorito($this->input->post("id_producto"),$this->input->post("estado"));
	}

}
