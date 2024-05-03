<?php
    class Ventas_model extends CI_Model{

        public function paga_venta($idusuario){            
            $this->db->set('estatus', 1);
            $this->db->where('id_usuario', $idusuario); // Corregido para utilizar el parámetro
            $this->db->where('estatus', 0);
            $this->db->update('carrito');
        
            return $this->db->affected_rows() > 0 ? TRUE : FALSE; // Corregido para devolver FALSE en lugar de NULL
        }
        
        //
        /*public function get_compras( $idusuario ){ 
            $this->db->select('
            pagos.id AS id_pago,
            pagos.metodo_pago,
            pagos.monto,
            pagos.fecha_pago,
            vuelos.id AS id_vuelo,
            vuelos.numero_vuelo,
            vuelos.costo_vuelo,
            vuelos.img_vuelo,
            aeropuertos_origen.codigo AS codigo_origen,
            aeropuertos_origen.nombre AS nombre_origen,
            aeropuertos_origen.ciudad AS ciudad_origen,
            aeropuertos_origen.pais AS pais_origen,
            aeropuertos_destino.codigo AS codigo_destino,
            aeropuertos_destino.nombre AS nombre_destino,
            aeropuertos_destino.ciudad AS ciudad_destino,
            aeropuertos_destino.pais AS pais_destino
        ');
        
            $this->db->from('pagos');
            $this->db->join('vuelos', 'pagos.id_vuelo = vuelos.id');
            $this->db->join('aeropuertos AS aeropuertos_origen', 'vuelos.aeropuerto_origen_id = aeropuertos_origen.id');
            $this->db->join('aeropuertos AS aeropuertos_destino', 'vuelos.aeropuerto_destino_id = aeropuertos_destino.id');
            $this->db->where('pagos.id_usuario', $idusuario);
            
            $query = $this->db->get();                                
            return $query->num_rows() > 0 ? $query->result() : NULL;
        }*/
        public function detalle_compras($usuario,$fecha){
            //$fechaDecodificada = urldecode($fecha);
            $fecha_decoded = urldecode($fecha);
            $this->db->select('pagos.id AS factura_id, pagos.fecha_pago AS fecha_emision, SUM(carrito.precio_total) AS monto_total, GROUP_CONCAT(detalle_pago.no_asiento ORDER BY detalle_pago.no_asiento) AS asientos_asignados, vuelos.id AS vuelo_id, vuelos.numero_vuelo, vuelos.fecha_salida, vuelos.fecha_llegada, vuelos.costo_vuelo, vuelos.img_vuelo, aeropuertos_origen.nombre AS aeropuerto_origen, aeropuertos_origen.ciudad AS ciudad_origen, aeropuertos_destino.nombre AS aeropuerto_destino, aeropuertos_destino.ciudad AS ciudad_destino', FALSE);
            $this->db->from('pagos');
            $this->db->join('carrito', 'pagos.id = carrito.id');
            $this->db->join('usuarios', 'pagos.id_usuario = usuarios.id');
            $this->db->join('vuelos', 'carrito.id_vuelo = vuelos.id');
            $this->db->join('aeropuertos AS aeropuertos_origen', 'vuelos.aeropuerto_origen_id = aeropuertos_origen.id');
            $this->db->join('aeropuertos AS aeropuertos_destino', 'vuelos.aeropuerto_destino_id = aeropuertos_destino.id', 'left');
            $this->db->join('detalle_pago', 'carrito.id = detalle_pago.id_carrito', 'left');
            $this->db->where('pagos.fecha_pago', $fecha_decoded);
            $this->db->where('pagos.id_usuario', $usuario);
            $this->db->group_by('pagos.id, vuelos.id');
            $this->db->order_by('pagos.fecha_pago', 'DESC');
            $this->db->limit(1000);
        
            $query = $this->db->get();
            return $query->num_rows() > 0 ? $query->result() : NULL;
        }
        public function historial_compras($idUsuario){
            $this->db->select('
            MAX(pagos.id) AS factura_id,
            MAX(pagos.fecha_pago) AS fecha_compra,
            SUM(carrito.precio_total) AS monto_total,
            GROUP_CONCAT(detalle_pago.no_asiento ORDER BY detalle_pago.no_asiento) AS asientos_asignados
            ');
            $this->db->from('pagos');
            $this->db->join('carrito', 'pagos.id = carrito.id');
            $this->db->join('detalle_pago', 'carrito.id = detalle_pago.id_carrito', 'left');
            $this->db->where('pagos.id_usuario', $idUsuario);
            $this->db->group_by('pagos.fecha_pago');
            $this->db->order_by('pagos.fecha_pago', 'asc');  // Cambiado a ASC (Ascendente)
            
            $query = $this->db->get();
            return $query->num_rows() > 0 ? $query->result() : NULL;
        }

        public function get_compras($id_usuario) {
            $this->db->select('
                facturas.id AS factura_id,
                facturas.id_vuelo,
                facturas.id_usuario,
                facturas.fecha_emision,
                facturas.monto_total,
                facturas.rfc_cliente,
                usuarios.id AS usuario_id,
                usuarios.nombre AS usuario_nombre,
                usuarios.email AS usuario_email,
                usuarios.direccion AS usuario_direccion,
                usuarios.telefono AS usuario_telefono,
                vuelos.id AS vuelo_id,
                vuelos.aeropuerto_origen_id,
                vuelos.aeropuerto_destino_id,
                vuelos.fecha_salida,
                vuelos.fecha_llegada,
                vuelos.numero_vuelo,
                vuelos.costo_vuelo,
                vuelos.img_vuelo,
                aeropuertos_origen.id AS aeropuerto_origen_id,
                aeropuertos_origen.codigo AS aeropuerto_origen_codigo,
                aeropuertos_origen.nombre AS aeropuerto_origen_nombre,
                aeropuertos_origen.ciudad AS aeropuerto_origen_ciudad,
                aeropuertos_origen.pais AS aeropuerto_origen_pais,
                aeropuertos_destino.id AS aeropuerto_destino_id,
                aeropuertos_destino.codigo AS aeropuerto_destino_codigo,
                aeropuertos_destino.nombre AS aeropuerto_destino_nombre,
                aeropuertos_destino.ciudad AS aeropuerto_destino_ciudad,
                aeropuertos_destino.pais AS aeropuerto_destino_pais,
                pagos.id AS pago_id,
                pagos.metodo_pago,
                pagos.monto,
                pagos.fecha_pago,
                pagos.no_asiento
            ');
        
            $this->db->from('facturas');
            $this->db->join('usuarios', 'facturas.id_usuario = usuarios.id');
            $this->db->join('vuelos', 'facturas.id_vuelo = vuelos.id');
            $this->db->join('aeropuertos AS aeropuertos_origen', 'vuelos.aeropuerto_origen_id = aeropuertos_origen.id');
            $this->db->join('aeropuertos AS aeropuertos_destino', 'vuelos.aeropuerto_destino_id = aeropuertos_destino.id');
            $this->db->join('pagos', 'facturas.id_usuario = pagos.id_usuario AND facturas.id_vuelo = pagos.id_vuelo', 'left');
            $this->db->where('facturas.id_usuario', $id_usuario);
        
            $query = $this->db->get();

        
            return $query->num_rows() > 0 ? $query->result() : NULL;
        }
                

        public function get_factura($idfactura){
            $this->db->select('*');
            $this->db->from('facturas');
            $query = $this->db->get();        
            return $query->num_rows()>0 ?$query->result():NULL;            
        }

        // En TuModelo.php
        public function generate_xml($idusuario,$fecha) {
            /*$this->db->select('
            facturas.id AS factura_id,
            facturas.id_vuelo,
            facturas.id_usuario,
            facturas.fecha_emision,
            facturas.monto_total,
            facturas.rfc_cliente,
            usuarios.id AS usuario_id,
            usuarios.nombre AS usuario_nombre,
            usuarios.email AS usuario_email,
            usuarios.direccion AS usuario_direccion,
            usuarios.telefono AS usuario_telefono,
            vuelos.id AS vuelo_id,
            vuelos.aeropuerto_origen_id,
            vuelos.aeropuerto_destino_id,
            vuelos.fecha_salida,
            vuelos.fecha_llegada,
            vuelos.numero_vuelo,
            vuelos.costo_vuelo,
            vuelos.img_vuelo,
            aeropuertos_origen.id AS aeropuerto_origen_id,
            aeropuertos_origen.codigo AS aeropuerto_origen_codigo,
            aeropuertos_origen.nombre AS aeropuerto_origen_nombre,
            aeropuertos_origen.ciudad AS aeropuerto_origen_ciudad,
            aeropuertos_origen.pais AS aeropuerto_origen_pais,
            aeropuertos_destino.id AS aeropuerto_destino_id,
            aeropuertos_destino.codigo AS aeropuerto_destino_codigo,
            aeropuertos_destino.nombre AS aeropuerto_destino_nombre,
            aeropuertos_destino.ciudad AS aeropuerto_destino_ciudad,
            aeropuertos_destino.pais AS aeropuerto_destino_pais,
            pagos.id AS pago_id,
            pagos.metodo_pago,
            pagos.monto,
            pagos.fecha_pago,
            pagos.no_asiento
        ');
    
        $this->db->from('facturas');
        $this->db->join('usuarios', 'facturas.id_usuario = usuarios.id');
        $this->db->join('vuelos', 'facturas.id_vuelo = vuelos.id');
        $this->db->join('aeropuertos AS aeropuertos_origen', 'vuelos.aeropuerto_origen_id = aeropuertos_origen.id');
        $this->db->join('aeropuertos AS aeropuertos_destino', 'vuelos.aeropuerto_destino_id = aeropuertos_destino.id');
        $this->db->join('pagos', 'facturas.id_usuario = pagos.id_usuario AND facturas.id_vuelo = pagos.id_vuelo', 'left');
        //$this->db->where('facturas.id_usuario', $idusuario);            
        $this->db->where('facturas.estatus', 1);            

            $query = $this->db->get();*/
            $this->db->select('
            MAX(pagos.id) AS factura_id,
            carrito.id_vuelo,
            pagos.id_usuario,
            MAX(pagos.fecha_pago) AS fecha_emision,
            SUM(carrito.precio_total) AS monto_total,            
            usuarios.id AS usuario_id,
            usuarios.nombre AS usuario_nombre,
            usuarios.email AS usuario_email,
            usuarios.direccion AS usuario_direccion,
            usuarios.telefono AS usuario_telefono,
            vuelos.id AS vuelo_id,
            vuelos.aeropuerto_origen_id,
            vuelos.aeropuerto_destino_id,
            vuelos.fecha_salida,
            vuelos.fecha_llegada,
            vuelos.numero_vuelo,
            vuelos.costo_vuelo,
            vuelos.img_vuelo,
            aeropuertos_origen.id AS aeropuerto_origen_id,
            aeropuertos_origen.codigo AS aeropuerto_origen_codigo,
            aeropuertos_origen.nombre AS aeropuerto_origen_nombre,
            aeropuertos_origen.ciudad AS aeropuerto_origen_ciudad,
            aeropuertos_origen.pais AS aeropuerto_origen_pais,
            aeropuertos_destino.id AS aeropuerto_destino_id,
            aeropuertos_destino.codigo AS aeropuerto_destino_codigo,
            aeropuertos_destino.nombre AS aeropuerto_destino_nombre,
            aeropuertos_destino.ciudad AS aeropuerto_destino_ciudad,
            aeropuertos_destino.pais AS aeropuerto_destino_pais,
            GROUP_CONCAT(detalle_pago.no_asiento ORDER BY detalle_pago.no_asiento) AS asientos_asignados
        ');
        $this->db->from('pagos');
        $this->db->join('carrito', 'pagos.id = carrito.id');
        $this->db->join('usuarios', 'pagos.id_usuario = usuarios.id');
        $this->db->join('vuelos', 'carrito.id_vuelo = vuelos.id');
        $this->db->join('aeropuertos AS aeropuertos_origen', 'vuelos.aeropuerto_origen_id = aeropuertos_origen.id');
        $this->db->join('aeropuertos AS aeropuertos_destino', 'vuelos.aeropuerto_destino_id = aeropuertos_destino.id', 'left');
        $this->db->join('detalle_pago', 'carrito.id = detalle_pago.id_carrito', 'left');
        $this->db->where('pagos.fecha_pago', $fecha);  // Reemplaza con la fecha que necesitas
        $this->db->where('pagos.id_usuario',$idusuario);  // Reemplaza con el ID de usuario que necesitas
        $this->db->group_by('carrito.id_vuelo, pagos.id_usuario');
        $this->db->order_by('MAX(pagos.fecha_pago)', 'DESC');
        $this->db->limit(1000);
        
        $query = $this->db->get();
        
        $result = $query->result();
        

        
            // Verificar si se encontraron facturas
            if ($query->num_rows() > 0) {
                // Construir el contenido XML
                $xmlString = '<?xml version="1.0" encoding="UTF-8"?>';
                $xmlString .= '<facturas>';
        
                foreach ($query->result() as $factura) {
                    $subtotal=$factura->monto_total-($factura->monto_total*0.16);
                    $iva=$factura->monto_total*0.16;
                    $xmlString .= '<factura>';
                    //$xmlString .= '<factura_id>' . $factura->factura_id . '</factura_id>';
                    //$xmlString .= '<id_vuelo>' . $factura->id_vuelo . '</id_vuelo>';
                    //$xmlString .= '<id_usuario>' . $factura->id_usuario . '</id_usuario>';
                    $xmlString .= '<fecha_emision>' . $factura->fecha_emision . '</fecha_emision>';
                    //$xmlString .= '<rfc_cliente>' . $factura->rfc_cliente . '</rfc_cliente>';
                    //$xmlString .= '<usuario_id>' . $factura->usuario_id . '</usuario_id>';
                    //$xmlString .= '<usuario_nombre>' . $factura->usuario_nombre . '</usuario_nombre>';
                    $xmlString .= '<correo_usuario>' . $factura->usuario_email . '</correo_usuario>';
                    $xmlString .= '<usuario_direccion>' . $factura->usuario_direccion . '</usuario_direccion>';
                    $xmlString .= '<usuario_telefono>' . $factura->usuario_telefono . '</usuario_telefono>';
                    $xmlString .= '<fecha_salida>' . $factura->fecha_salida . '</fecha_salida>';
                    $xmlString .= '<fecha_llegada>' . $factura->fecha_llegada . '</fecha_llegada>';
                    $xmlString .= '<numero_vuelo>' . $factura->numero_vuelo . '</numero_vuelo>';
                    $xmlString .= '<costo_vuelo>' . $factura->monto_total . '</costo_vuelo>';
                    //$xmlString .= '<img_vuelo>' . $factura->img_vuelo . '</img_vuelo>';
                    $xmlString .= '<aeropuerto_origen_nombre>' . $factura->aeropuerto_origen_nombre . '</aeropuerto_origen_nombre>';
                    $xmlString .= '<aeropuerto_origen_ciudad>' . $factura->aeropuerto_origen_ciudad . '</aeropuerto_origen_ciudad>';
                    $xmlString .= '<aeropuerto_origen_pais>' . $factura->aeropuerto_origen_pais . '</aeropuerto_origen_pais>';
                    //$xmlString .= '<aeropuerto_destino_codigo>' . $factura->aeropuerto_destino_codigo . '</aeropuerto_destino_codigo>';
                    $xmlString .= '<aeropuerto_destino_nombre>' . $factura->aeropuerto_destino_nombre . '</aeropuerto_destino_nombre>';
                    $xmlString .= '<destino_ciudad>' . $factura->aeropuerto_destino_ciudad . '</destino_ciudad>';
                    $xmlString .= '<pais_origen>' . $factura->aeropuerto_destino_pais . '</pais_origen>';
                    $xmlString .= '<numero_asiento>' . $factura->asientos_asignados . '</numero_asiento>';
                    $xmlString .= '<iva>'.$iva.'</iva>';
                    $xmlString .= '<subtotal>' . $subtotal . '</subtotal>';                    
                    $xmlString .= '<monto_total>' . $factura->monto_total . '</monto_total>';
                    $xmlString .= "<metodo_pago>Paypal</metodo_pago>";


                    // Otros campos adicionales aquí
                    $xmlString .= '</factura>';
                }
                
        
                $xmlString .= '</facturas>';
                return $xmlString;
            } else {
                return NULL;  // Manejar el caso en que no se encuentren facturas
            }
        }
        
        
        

        public function addrfc($rfc,$idusuario){ 
            $rs=$this->db
            ->insert('factura',array(
                'id_usuario' => $idusuario,
                'rfc_cliente' =>$rfc
            ));      
            return $this->db->insert_id();            
        }
        
    }
?>