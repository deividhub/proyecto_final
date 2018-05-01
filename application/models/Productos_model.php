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


        public function obtener_productos_genero($genero){
                $sql = "SELECT * FROM producto WHERE genero='$genero'";
                $query=$this->db->query($sql);
                return $query->result();             
        }

        public function obtener_productos_rdm(){

                $sql = "SELECT * FROM producto  ORDER BY RAND() LIMIT 5";
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


        public function obtener_estilo_tipos($id_tipo){
                $sql = "SELECT * FROM estilo WHERE id_tipo_producto=$id_tipo";
                $query=$this->db->query($sql);
                return $query->result();
        }

        public function comprobar_stock($producto){
            $p=json_decode($producto);// codifico
            for ($i=0; $i <count($p) ; $i++) { 
                $sql = "SELECT stock FROM talla_producto WHERE id_talla=".$p[$i]->talla." AND id_producto=".$p[$i]->producto."";
                $query=$this->db->query($sql); 
                foreach ($query->result() as $key) {
                    if($key->stock<$p[$i]->count){
                        return 0;
                    }
                }  
            }

        }
        public function generar_pedido($producto,$usuario,$precio,$fecha){
            $u=json_decode($usuario);// codifico
            $p=json_decode($producto);// codifico
            $sql = "INSERT INTO pedido VALUES(NULL,'".$u[0]->id_usuario."',".$precio.",'".$fecha."','1')";
            $query=$this->db->query($sql);
            // obtener id maximo
            $max = "SELECT MAX(id_pedido) maximo FROM pedido";
            $maxQuery=$this->db->query($max);
            foreach ($maxQuery->result() as $key) {
                $maximo=$key->maximo;
            }
            for ($i=0; $i <count($p) ; $i++) { 
                $sql = "INSERT INTO pedido_producto VALUES(NULL,".$maximo.",".$u[0]->id_usuario.",".$p[$i]->producto.",".$p[$i]->precio.",".$p[$i]->count.",0)";
                $query=$this->db->query($sql);   
            }


            for ($i=0; $i <count($p) ; $i++) { 
                $sql = "UPDATE talla_producto SET stock=stock-".$p[$i]->count." WHERE id_producto=".$p[$i]->producto." AND id_talla=".$p[$i]->talla."";
                $query=$this->db->query($sql);   
            }


        }


        public function favorito($producto,$estado){
            if ($estado=="true") {
                $sql = "DELETE FROM favorito WHERE id_producto=$producto AND id_usuario=2";
               
            }
            else{
                $sql = "INSERT INTO favorito VALUES(NULL,2,$producto)";
            }
                $query=$this->db->query($sql); 

        }
        public function obtener_favoritos($id_producto){

            $sql = "SELECT * FROM favorito WHERE id_producto=$id_producto";
            $query=$this->db->query($sql); 
            return $query->result();
        }


        public function permitir_comentar($id_producto){
            $sql = "SELECT * FROM pedido_producto WHERE id_producto=$id_producto AND id_usuario=2 AND comentario=0";
            $query=$this->db->query($sql); 
            return $query->num_rows();
        }

        public function comentar($id_producto,$comentario){
            $sql = "INSERT INTO comentario VALUES(NULL,$id_producto,2,'".$comentario."')";
            $this->db->query($sql); 
            $sql2 = "UPDATE pedido_producto SET comentario=1 WHERE id_usuario=2 AND id_producto=$id_producto";
            $this->db->query($sql2); 
        }

        public function obtener_pedidos(){
            $sql = "SELECT * FROM pedido p, estado_pedido e WHERE p.id_estado=e.id_estado";
            $query=$this->db->query($sql); 
            return $query->result();
        }

        public function obtener_estados(){
            $sql = "SELECT * FROM estado_pedido";
            $query=$this->db->query($sql); 
            return $query->result();
        }

        public function obtener_stock_total(){
            $sql = "SELECT * FROM talla_producto tp, producto p, talla t WHERE tp.id_producto=p.id_producto AND t.id_talla=tp.id_talla";
            $query=$this->db->query($sql); 
            return $query->result();
        }

}


 ?>
