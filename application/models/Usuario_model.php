<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

        public function obtener_usuarios()
        {
                $sql = "SELECT * FROM usuario";
                $query=$this->db->query($sql);
                return $query->result();
        }

        public function obtener_usuario($id)
        {
                $sql = "SELECT * FROM usuario WHERE id_usuario=$id";
                $query=$this->db->query($sql);
                return $query->result();
        }

        public function editar_usuario($id)
        {
                $sql = "SELECT * FROM usuario WHERE id_usuario=$id";
                $query=$this->db->query($sql);
                return $query->result();
        }

        // select para obtener los pedidos
        public function obtener_pedidos_usuario(){

                $sql = "SELECT * FROM pedido, estado_pedido WHERE id_usuario=".$this->session->userdata('id')." AND pedido.id_estado= estado_pedido.id_estado ORDER BY pedido.id_estado ASC";
                $query=$this->db->query($sql);
                return $query->result();   
        }

        // para cuando se selecciona un pedido obtener esos productos
        public function obtener_productos_pedido_usuario($id_pedido){
                $sql = "SELECT * FROM pedido_producto pp, producto p WHERE pp.id_pedido=$id_pedido AND p.id_producto=pp.id_producto AND id_usuario=".$this->session->userdata('id')."";
                $query=$this->db->query($sql);
                return $query->result();  
        }

        public function obtener_favoritos_usuario(){

                $sql = "SELECT * FROM favorito f, producto p WHERE f.id_producto=p.id_producto AND id_usuario=".$this->session->userdata('id')."";
                $query=$this->db->query($sql);
                return $query->result();   
        }


        public function recuperar_contrasena($pass){
                $sql = "UPDATE usuario SET contraseña='".$pass."' WHERE id_usuario=".$this->session->userdata('id')."";
                $query=$this->db->query($sql);
        }
}


 ?>
