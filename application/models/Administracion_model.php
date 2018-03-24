<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion_model extends CI_Model {

        
        public function crear_producto($producto)
        {		
        		// añadir el producto

        		$this->db->insert('producto',$producto);
        		return $producto;
        		// cojer el id que se ha metido de ese producto
                //$max = "SELECT MAX(id_producto) maximo FROM producto";
               // $maxQuery=$this->db->query($max);
               // foreach ($maxQuery->result() as $key) {
              //  	$maximo=$key->maximo;
               // }

               // // cojer las tallas de ese tipo de producto
               // $tallas = "SELECT * from talla WHERE id_tipo_producto='".$producto['id_tipo_producto']."'";
               // $tallasQuery=$this->db->query($tallas);

               // foreach ($tallasQuery->result() as $key) {
	                // ahora rellenar el stock
	         	//	$añadirStock="INSERT INTO talla_producto VALUES('".$key->id_talla."','".$maximo."',15)";
	           //     $this->db->query($añadirStock);
                //}
        }



        public function editar_usuario($array_usuario,$id){

          $this->db->where('id_usuario', $id);
          $this->db->update('usuario', $array_usuario);

        }
       public function crear_usuario($array_usuario){

          $this->db->insert('usuario', $array_usuario);

        }
        public function eliminar_usuario($id){

          $this->db->where('id_usuario', $id);
          $this->db->delete('usuario');

        }
}


 ?>
