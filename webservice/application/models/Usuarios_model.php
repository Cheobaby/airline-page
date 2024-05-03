<?php
    class Usuarios_model extends CI_Model{
        //correcta
        public function get_cliente($idusuario){
            $rs=$this->db
            ->select('*')
            ->from('usuarios')
            ->where('id',$idusuario)
            ->get();
            return $rs->num_rows() > 0 ? $rs->row() : NULL;
        }
        //CORRECTA
        public function acceso_usuario($correo,$contrasenia){
            $rs=$this->db
            ->select('*')
            ->from('usuarios')
            ->where('email',$correo)
            ->where('contrasena',$contrasenia)
            ->get();
            return $rs->num_rows() > 0 ? $rs->row() : NULL;
        }
        //correcta
        public function insert_usuario($data){
            $rs=$this->db->insert("Usuarios",$data);
            return $rs ? $this->db->insert_id() : -1;
            //return $rs->insert_id();
        }
        //CORRECTA
        public function get_deseos($idUsuario) {
            $this->db->select('ld.id AS id_listadeseos, ld.id_usuario, ld.id_vuelo,
            v.id AS id_vuelo, v.aeropuerto_origen_id, v.aeropuerto_destino_id,
            v.fecha_salida, v.fecha_llegada, v.numero_vuelo, v.costo_vuelo, v.img_vuelo,
            ao.codigo AS codigo_origen, ao.nombre AS nombre_origen, ao.ciudad AS ciudad_origen, ao.pais AS pais_origen,
            ad.codigo AS codigo_destino, ad.nombre AS nombre_destino, ad.ciudad AS ciudad_destino, ad.pais AS pais_destino');
            $this->db->from('listadeseos ld');
            $this->db->join('vuelos v', 'ld.id_vuelo = v.id');
            $this->db->join('aeropuertos ao', 'v.aeropuerto_origen_id = ao.id');
            $this->db->join('aeropuertos ad', 'v.aeropuerto_destino_id = ad.id');
            $this->db->where('ld.id_usuario', $idUsuario);

            $query = $this->db->get();

            return $query->num_rows() > 0 ? $query->result() : NULL;
        }
        //CORRECTA
        public function delete_deseo($id){
            $this->db->where('id', $id);            
            $rs = $this->db->delete('listadeseos');
            
            // Verificar si la eliminación fue exitosa
            return $rs ? TRUE : FALSE;
        }
        

        public function insert_deseo($id_usuario, $id_vuelo){
            $rs=$this->db
            ->insert('listadeseos',array(
                'id_usuario' => $id_usuario,
                'id_vuelo'   => $id_vuelo
            ));
            return $this->db->insert_id();
        }

        //correcta
        public function update_usuario($data){            
            $this->db
                ->where('id', $data['id'])
                ->update('usuarios', $data);
        
            return $this->db->trans_status();
        }
        public function update_cliente($data){
            $this->db
            ->where('id', $data['id'])
            ->update('pasajeros', $data);
    
            return $this->db->trans_status();
        }   
                
        /*public function get_carrito($id_usu){
            $this->db->select('carrito.id, carrito.id_vuelo, carrito.id_usuario, carrito.cantidad, carrito.subtotal, carrito.precio_total,carrito.total, 
            vuelos.id AS vuelo_id, vuelos.aeropuerto_origen_id, vuelos.aeropuerto_destino_id,
            vuelos.fecha_salida, vuelos.fecha_llegada, vuelos.numero_vuelo, vuelos.costo_vuelo, vuelos.img_vuelo,aeropuertos.pais,aeropuertos.ciudad');
            $this->db->from('carrito');
            $this->db->join('vuelos', 'carrito.id_vuelo = vuelos.id');
            $this->db->join('aeropuertos','vuelos.id=aeropuertos.id');
            $this->db->where('carrito.id_usuario', $id_usu);
            $this->db->where('estatus',0);
        
            $query = $this->db->get();
        
            return $query->num_rows() > 0 ? $query->result() : NULL;
        }*/

        public function get_carrito($id_usu){
            $this->db->select('carrito.id, carrito.id_vuelo, carrito.id_usuario, carrito.cantidad, carrito.subtotal, carrito.precio_total, carrito.total, 
            vuelos.id AS vuelo_id, vuelos.aeropuerto_origen_id, vuelos.aeropuerto_destino_id,
            vuelos.fecha_salida, vuelos.fecha_llegada, vuelos.numero_vuelo, vuelos.costo_vuelo, vuelos.img_vuelo,
            aeropuertos_origen.ciudad AS ciudad_origen,
            aeropuertos_destino.ciudad AS ciudad_destino,
            aeropuertos_origen.pais AS pais_origen,
            aeropuertos_destino.pais AS pais_destino');
            $this->db->from('carrito');
            $this->db->join('vuelos', 'carrito.id_vuelo = vuelos.id');
            $this->db->join('aeropuertos AS aeropuertos_origen', 'vuelos.aeropuerto_origen_id = aeropuertos_origen.id');
            $this->db->join('aeropuertos AS aeropuertos_destino', 'vuelos.aeropuerto_destino_id = aeropuertos_destino.id');
            $this->db->where('carrito.id_usuario', $id_usu);
            $this->db->where('estatus', 0);

            $result = $this->db->get();

        
            return $result->num_rows() > 0 ? $result->result() : NULL;
        }

        
        public function borra_Carrito($id){
            $this->db->where('id', $id);            
            $rs = $this->db->delete('carrito');
            
            // Verificar si la eliminación fue exitosa
            return $rs ? TRUE : FALSE;
        }        
        
    }
?>



