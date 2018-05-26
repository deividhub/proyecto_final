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
                $sql = "SELECT * FROM producto WHERE genero='$genero' ORDER BY precio";
                $query=$this->db->query($sql);
                return $query->result();             
        }

        public function obtener_productos_rdm(){

                $sql = "SELECT * FROM producto  ORDER BY RAND() LIMIT 4";
                $query=$this->db->query($sql);
                return $query->result();
        }
        public function obtener_productos(){
                if($this->session->userdata('genero')){
                    $genero=$this->session->userdata('genero');
                    $sql = "SELECT * FROM producto WHERE genero='".$genero."' ORDER BY precio";
                }
                else{
                    $sql = "SELECT * FROM producto ORDER BY precio";
                }
                $query=$this->db->query($sql);
                return $query->result();
        }
        public function obtener_productos_adm(){
           
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
                if($this->session->userdata('genero')){
                    $genero=$this->session->userdata('genero');
                    $sql = "SELECT * FROM producto WHERE id_tipo_producto=$id_tipo_producto AND genero='".$genero."' ORDER BY precio";
                }
                else{
                    $sql = "SELECT * FROM producto WHERE id_tipo_producto=$id_tipo_producto ORDER BY precio";
                }
                $query=$this->db->query($sql);
                return $query->result();
        }

        public function obtener_productos_estilo($id_estilo){
                if($this->session->userdata('genero')){
                    $genero=$this->session->userdata('genero');
                    $sql = "SELECT * FROM producto WHERE id_estilo=$id_estilo AND genero='".$genero."' ORDER BY precio";
                }
                else{
                    $sql = "SELECT * FROM producto WHERE id_estilo=$id_estilo ORDER BY precio";
                }
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
            $array_sin_stock=Array();
            $contador_s_s=0;
            for ($i=0; $i <count($p) ; $i++) { 
                $sql = "SELECT * FROM talla_producto tp, producto p, talla t WHERE t.id_talla=tp.id_talla AND p.id_producto=tp.id_producto AND tp.id_talla=".$p[$i]->talla." AND tp.id_producto=".$p[$i]->producto."";
                $query=$this->db->query($sql); 
                foreach ($query->result() as $key) {
                    if($key->stock<$p[$i]->count){
                        $array_sin_stock[$contador_s_s]['nombre']=$key->nombre_producto;
                        $array_sin_stock[$contador_s_s]['talla']=$key->descripcion;
                        $array_sin_stock[$contador_s_s]['stock']=$key->stock;
                        $contador_s_s++;
                    }
                }  
            }

            if (count($array_sin_stock)>0)
            {
               return $array_sin_stock;
            }
            else{
                return 0;
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
            if($this->session->userdata('id')){
                if ($estado=="true") {
                $sql = "DELETE FROM favorito WHERE id_producto=$producto AND id_usuario=".$this->session->userdata('id')."";
               
            }
            else{
                $sql = "INSERT INTO favorito VALUES(NULL,".$this->session->userdata('id').",$producto)";
            }
                $query=$this->db->query($sql); 

            }
            
        }
        public function obtener_favoritos($id_producto){
            if($this->session->userdata('id')){
                $sql = "SELECT * FROM favorito WHERE id_producto=$id_producto AND id_usuario=".$this->session->userdata('id')."";
                $query=$this->db->query($sql); 
                return $query->result();     
            }

        }


        public function permitir_comentar($id_producto){
            if($this->session->userdata('id')){
                $sql = "SELECT * FROM pedido_producto WHERE id_producto=$id_producto AND id_usuario=".$this->session->userdata('id')." AND comentario=0";
                $query=$this->db->query($sql); 
                return $query->num_rows();   
            }
            else{
                return 0;
            }

        }

        public function comentar($id_producto,$comentario,$fecha){
        
            $sql = "INSERT INTO comentario VALUES(NULL,$id_producto,".$this->session->userdata('id').",'".$comentario."','".$fecha."')";
            $this->db->query($sql); 


            $select="SELECT * FROM pedido_producto WHERE id_usuario=".$this->session->userdata('id')." AND id_producto=$id_producto AND comentario=0";
            $query=$this->db->query($select); 
            foreach($query->result() as $key){
                $pedido_producto= $key->id_pedido_producto;
            }

            $sql2 = "UPDATE pedido_producto SET comentario=1 WHERE id_usuario=".$this->session->userdata('id')." AND id_producto=$id_producto AND id_pedido_producto=$pedido_producto";
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

        public function count_pedidos(){
            $sql = "SELECT count(*) cantidad FROM pedido";
            $query=$this->db->query($sql); 
            foreach($query->result() as $key){
                return $key->cantidad;
            }
        }

}


 ?>
