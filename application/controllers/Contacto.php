<?php

/*Este controlador es para lo siguiente:

	- Mandar mensaje desde la página de "Contacto" a la cuenta de gmail de la tienda.	- 

*/

defined('BASEPATH') OR exit('No direct script access allowed');


class Contacto extends CI_Controller {


	function __construct() {
	    parent::__construct();
		$this->load->helper('url');
		$this->load->model('Contacto_model');
	}


	/*ENVIAR MENSAJE*/
	public function enviar_mensaje(){

		$mensaje = array(
	        'nombre_contacto' => $this->input->post('nombre_contacto'),

	        'correo_contacto' => $this->input->post('correo_contacto'),

	        'select_contacto'  => $this->input->post('select_contacto'),
	        
	        'mensaje_contacto'  => $this->input->post('mensaje_contacto')
		);
		
		$result=$this->Contacto_model->enviar_mensaje($mensaje);			
	}
}
