<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion_model extends CI_Model {

        public function crear_producto($producto)
        {		
        		// añadir el producto

        		$this->db->insert('producto',$producto);
        		//return $producto;
        		// cojer el id que se ha metido de ese producto
                $max = "SELECT MAX(id_producto) maximo FROM producto";
                $maxQuery=$this->db->query($max);
                foreach ($maxQuery->result() as $key) {
                	$maximo=$key->maximo;
                }

               // // cojer las tallas de ese tipo de producto
                $tallas = "SELECT * from talla WHERE id_tipo_producto='".$producto['id_tipo_producto']."'";
                $tallasQuery=$this->db->query($tallas);

                foreach ($tallasQuery->result() as $key) {
	                // ahora rellenar el stock
	         		$añadirStock="INSERT INTO talla_producto VALUES(NULL,".$key->id_talla.",".$maximo.",15)";
	                $this->db->query($añadirStock);
                }
        }



        public function editar_producto($array_producto,$id){
          $this->db->where('id_producto', $id);
          $this->db->update('producto', $array_producto);

        }

         public function eliminar_producto($id){
            $sql = "UPDATE producto SET estado='ELIMINADO' WHERE id_producto=$id";
            $query=$this->db->query($sql);
          }
        public function editar_usuario($array_usuario,$id){

          $this->db->where('id_usuario', $id);
          $this->db->update('usuario', $array_usuario);

        }

       public function crear_usuario($array_usuario){

          $this->db->insert('usuario', $array_usuario);

        }
        public function eliminar_usuario($id){
          $sql = "UPDATE usuario SET estado='ELIMINADO' WHERE id_usuario=$id";
          $query=$this->db->query($sql);

        }
        public function obtener_comentarios(){
            $sql = "SELECT * FROM comentario";
            $query=$this->db->query($sql);
            return $query->result();
        }

        public function eliminar_comentario($id){
            $this->db->where('id_comentario', $id);
            $this->db->delete('comentario');
        }

        public function actualizar_pedido($id,$state){
          $sql = "UPDATE pedido SET id_estado=$state WHERE id_pedido=$id";
          $query=$this->db->query($sql);
        }    

        public function actualizar_stock($id){
          $sql = "UPDATE talla_producto SET stock=15 WHERE id_talla_producto=$id";
          $query=$this->db->query($sql);
        }


       public function recuperar_pass($id){
            $sql = "SELECT * FROM usuario WHERE id_usuario=$id";
            $query=$this->db->query($sql);
            if($query->num_rows()>0){
                $pass=getdate();
                $pass=$pass['0'];
                $pass=md5($pass);
                $pass=substr($pass,-6);
                $sql2 = "UPDATE usuario SET contraseña='".md5($pass)."' WHERE id_usuario=$id";
                $this->db->query($sql2);
                return $pass;

            }
            else{
                return "ERROR";
            }
        }



}


 ?>
