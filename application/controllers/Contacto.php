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
		$this->load->library('Email');
	}


	/*ENVIAR MENSAJE*/
	public function enviar_mensaje(){
	         	         
		$confing =array(
		    'protocol'=>'smtp',
		    'smtp_host'=>"smtp.gmail.com",
		    'smtp_port'=>'465',
		    'smtp_user'=>"dwnpdshop@gmail.com",
		    'smtp_pass'=>"dwnpd2018",
		    'smtp_crypto'=>'ssl',              
		    'mailtype'=>'html', 
		     'validate' => true
		 
		    );
		    $this->email->initialize($confing);
		    $this->email->set_newline("\r\n");
		    $this->email->from($this->input->post('correo_contacto'));
		    $this->email->to("dwnpdshop@gmail.com");
		    $this->email->subject($this->input->post('select_contacto'));
		    $this->email->message($this->input->post('nombre_contacto').":<br>".$this->input->post('mensaje_contacto'));
		    $this->email->send();
	}
}
