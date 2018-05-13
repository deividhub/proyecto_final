<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Comentario_model extends CI_Model {

        public function obtener_comentarios()
        {
                $sql = "SELECT * FROM comentario";
                $query=$this->db->query($sql);
                return $query->result();
        }

        public function obtener_comentarios_producto($id_producto){
            $sql = "SELECT * FROM comentario, usuario WHERE id_producto='$id_producto' AND comentario.id_usuario=usuario.id_usuario";
            $query=$this->db->query($sql);
            return $query->result();
        }
        
        public function obtener_comentarios_usuario($id_usuario){
            $sql = "SELECT * FROM comentario WHERE id_usuario='$id_usuario'";
            $query=$this->db->query($sql);
            return $query->result();
        }
}


 ?>
