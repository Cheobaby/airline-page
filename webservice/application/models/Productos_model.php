<?php
    class Productos_model extends CI_Model{

        public function get_paises() {
            $this->db->distinct();
            $this->db->select('a.pais AS pais_destino');
            $this->db->from('vuelos v');
            $this->db->join('aeropuertos a', 'v.aeropuerto_destino_id = a.id');
            $query = $this->db->get();
        
            return $query->num_rows() > 0 ? $query->result() : NULL;
        }

        public function buscar_vuelo($busqueda) {
    $this->db->select('vuelos.id, vuelos.aeropuerto_origen_id, vuelos.aeropuerto_destino_id, vuelos.fecha_salida, vuelos.fecha_llegada, vuelos.numero_vuelo, vuelos.costo_vuelo, vuelos.img_vuelo, origen.codigo as origen_codigo, origen.nombre as origen_nombre, origen.ciudad as origen_ciudad, origen.pais as origen_pais, destino.codigo as destino_codigo, destino.nombre as destino_nombre, destino.ciudad as destino_ciudad, destino.pais as destino_pais');
    $this->db->from('vuelos');
    $this->db->join('aeropuertos as origen', 'vuelos.aeropuerto_origen_id = origen.id');
    $this->db->join('aeropuertos as destino', 'vuelos.aeropuerto_destino_id = destino.id');
    
    // Utiliza el parámetro $busqueda en lugar de la cadena estática 'tu_busqueda'
    $this->db->where("vuelos.numero_vuelo LIKE '%$busqueda%' OR 
                     origen.nombre LIKE '%$busqueda%' OR 
                     origen.ciudad LIKE '%$busqueda%' OR 
                     origen.pais LIKE '%$busqueda%' OR 
                     destino.nombre LIKE '%$busqueda%' OR 
                     destino.ciudad LIKE '%$busqueda%' OR 
                     destino.pais LIKE '%$busqueda%'");

    $query = $this->db->get();
    return $query->num_rows() > 0 ? $query->result() : NULL;
}
        public function getEstatus($id_usuario,$id_vuelo){
            $this->db->select('estatus');
            $this->db->from('carrito');
            $this->db->where('id_usuario',$id_usuario );
            $this->db->where('id_vuelo', $id_vuelo);
            $this->db->where('estatus',1);
            $query = $this->db->get();
        
            return $query->num_rows() == 1;
        }

        public function get_productos(){
            $this->db->select('vuelos.id, vuelos.aeropuerto_origen_id, vuelos.aeropuerto_destino_id, vuelos.fecha_salida, vuelos.fecha_llegada, vuelos.numero_vuelo, vuelos.costo_vuelo, vuelos.img_vuelo, origen.codigo as origen_codigo, origen.nombre as origen_nombre, origen.ciudad as origen_ciudad, origen.pais as origen_pais, destino.codigo as destino_codigo, destino.nombre as destino_nombre, destino.ciudad as destino_ciudad, destino.pais as destino_pais');
            $this->db->from('vuelos');
            $this->db->join('aeropuertos as origen', 'vuelos.aeropuerto_origen_id = origen.id');
            $this->db->join('aeropuertos as destino', 'vuelos.aeropuerto_destino_id = destino.id');
            //$this->db->limit(4);
            $query = $this->db->get();
            
            return $query->num_rows() > 0 ? $query->result() : NULL;
        }

        public function get_productos_por_pais($pais) {
            $this->db->select('vuelos.id, vuelos.aeropuerto_origen_id, vuelos.aeropuerto_destino_id, vuelos.fecha_salida, vuelos.fecha_llegada, vuelos.numero_vuelo, vuelos.costo_vuelo, vuelos.img_vuelo, origen.codigo as origen_codigo, origen.nombre as origen_nombre, origen.ciudad as origen_ciudad, origen.pais as origen_pais, destino.codigo as destino_codigo, destino.nombre as destino_nombre, destino.ciudad as destino_ciudad, destino.pais as destino_pais');
            $this->db->from('vuelos');
            $this->db->join('aeropuertos as origen', 'vuelos.aeropuerto_origen_id = origen.id');
            $this->db->join('aeropuertos as destino', 'vuelos.aeropuerto_destino_id = destino.id');
            $this->db->where('destino.pais', $pais);            

            $query = $this->db->get();
        
            return $query->num_rows() > 0 ? $query->result() : NULL;
        }
        
        //public function insertar_carrito
        
        public function get_tipos_producto($id_Cate){
            $rs=$this->db
            ->select("*")
            ->from("tproductos")
            ->where("id_Cate",$id_Cate)
            ->limit(2)
            ->get();
            return $rs->num_rows()>0 ? $rs->result() : NULL;
        }
                
        public function exist_wish($id_usuario,$id_vuelo){
            $this->db->select('*');
            $this->db->from('listadeseos');
            $this->db->where('id_usuario',$id_usuario );
            $this->db->where('id_vuelo', $id_vuelo);
        
            $query = $this->db->get();
        
            return $query->num_rows() == 1;
        }       
        public function add_carrito($id_usuario, $id_vuelo, $precio) {
            $this->db->insert('carrito', array(
                'id_usuario' => $id_usuario, 
                'id_vuelo' => $id_vuelo,
                'cantidad' => 1,
                'precio_total' => $precio,
                'estatus'  => 0,
                'total' => $precio
            ));
        
            return $this->db->insert_id();
        }
        
        public function update_car($id_usuario, $id_vuelo,$nuevaCantidad,$catidadAnterior) {                          
            $datosActualizados = array(
                'cantidad' => $nuevaCantidad +$catidadAnterior
            );
        
            $this->db
                ->where('id_usuario', $id_usuario)
                ->where('id_vuelo', $id_vuelo)
                ->update('carrito', $datosActualizados);
        
            return $this->db->affected_rows() > 0 ? TRUE : NULL;
        }     

        public function actualizar_cantidad($id_usu,$id_vuel,$cant,$tot){
            $data = array(
                'cantidad' => $cant,
                'total' => $tot
            );
            
            $this->db->where('id_vuelo', $id_vuel);
            $this->db->where('id_usuario', $id_usu);
            $this->db->update('carrito', $data);

            return $this->db->affected_rows() > 0 ? TRUE : NULL;
        }
        
        public function get_cantCar($id_usu,$id_vuelo){
            // Selecciona la columna 'cantidad' de la tabla 'carrito' donde 'id_vuelo' sea igual a $idVuelo y 'id_usuario' sea igual a $idUsuario
            $this->db->select('cantidad');
            $this->db->from('carrito');
            $this->db->where('id_vuelo', $id_vuelo);
            $this->db->where('id_usuario', $id_usu);

            // Ejecuta la consulta y obtén el resultado
            $query = $this->db->get();
            return $query->num_rows() > 0 ? $query->row()->cantidad : NULL;               
        }
        

        public function exists_car($id_usuario,$id_vuelo){
            $this->db->select('*');
            $this->db->from('carrito');
            $this->db->where('id_usuario',$id_usuario );
            $this->db->where('id_vuelo', $id_vuelo);
        
            $query = $this->db->get();
        
            return $query->num_rows() == 1;
        }
        public function cant_inventario($idVuelo){
             // Selecciona la columna 'cantidad_disponible' de la tabla 'inventario' donde 'id_vuelo' sea igual a $idVuelo
            $this->db->select('cantidad_disponible');
            $this->db->from('inventario');
            $this->db->where('id_vuelo', $idVuelo);

            // Ejecuta la consulta y obtén el resultado
            $query = $this->db->get();
            return $query->num_rows() > 0 ? $query->row()->cantidad_disponible : NULL;
            // Verifica si la consulta fue exitosa     
            
        }
    }
?>