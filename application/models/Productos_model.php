<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {



        public function obtener_categorias(){

        	    $sql = "SELECT * FROM tipo_producto";
                $query=$this->db->query($sql);
                return $query->result();
        }

        public function obtener_estilos(){

        	    $sql = "SELECT * FROM estilo";
                $query=$this->db->query($sql);
                return $query->result();
        }


        public function obtener_productos(){

                $sql = "SELECT * FROM producto";
                $query=$this->db->query($sql);
                return $query->result();
        }

        public function obtener_producto($id_producto){

                    $sql = "SELECT * FROM producto WHERE id_producto=$id_producto";
                $query=$this->db->query($sql);
                return $query->result();
        }

        public function obtener_tallas_producto($id_producto){
                $sql = "SELECT * from talla_producto tp, talla t WHERE tp.id_talla=t.id_talla AND id_producto=$id_producto";
                $query=$this->db->query($sql);
                return $query->result();
        }

        public function obtener_productos_tipo($id_tipo_producto){
                $sql = "SELECT * FROM producto WHERE id_tipo_producto=$id_tipo_producto";
                $query=$this->db->query($sql);
                return $query->result();
        }

        public function obtener_productos_estilo($id_estilo){
                $sql = "SELECT * FROM producto WHERE id_estilo=$id_estilo";
                $query=$this->db->query($sql);
                return $query->result();
        }


        public function obtener_precio_producto($id_producto){
                $sql = "SELECT * FROM producto WHERE id_producto=$id_producto";
                $query=$this->db->query($sql);
                return $query->result();
        }
        public function obtener_desc_talla_producto($id_talla){
                $sql = "SELECT * FROM talla WHERE id_talla=$id_talla";
                $query=$this->db->query($sql);
                return $query->result();
        }



}


 ?>
