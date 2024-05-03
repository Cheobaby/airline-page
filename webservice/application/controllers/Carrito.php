<?php
    class Carrito extends CI_Controller{
        public function __construct(){
            parent::__construct();
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, OPTIONS");
            $this->load->model('ventas_model');
            $this->load->model('productos_model');
            $this->load->model('usuarios_model');
            //$this->load->library('third_party/tcpdf/src/tcpdf');
        }     
        
        public function getproductos(){
            $result=$this->productos_model->get_productos();                                  
            $obj['resultado']=$result!=NULL;
            $obj['data']=$result;            
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        } 

        public function getcarrito(){
            $id_usu = $this->input->post('id_usu');
            $result = $this->usuarios_model->get_carrito($id_usu);
        
            $obj['resultado'] = $result !== NULL; // Verifica si $result no es NULL
            $obj['datos'] = $result; // Evita errores si $result es NULL
        
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }
        
        public function pagaventa(){
            $id_usu = $this->input->post('id');
            $result = $this->ventas_model->paga_venta($id_usu);
                    
            $obj['resultado'] = $result;
        
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        } 
        public function getcompras( $idusuario){
            $rs=$this->ventas_model->get_compras($idusuario);
            $obj['resultado']=$rs!=NULL;
            //$obj['cantidad'] = "Se encontraron " . count($rs) . " compra(s) realizada(s)";
            $obj['compras']=$rs;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);        
        } 
        public function detallecompras($idusuario,$fecha){
            $fechaEscapada = urlencode($fecha);
            $rs=$this->ventas_model->detalle_compras($idusuario,$fecha);
            $obj['resultado']=$rs!=NULL;
            //$obj['cantidad'] = "Se encontraron " . count($rs) . " compra(s) realizada(s)";
            $obj['compras']=$rs;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }
        public function historialcompras($idusuario){
            $rs=$this->ventas_model->historial_compras($idusuario);
            $obj['resultado']=$rs!=NULL;
            //$obj['cantidad'] = "Se encontraron " . count($rs) . " compra(s) realizada(s)";
            $obj['compras']=$rs;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }        
        /*public function getfactura(){
            $idUsuario = $this->input->post('idUsuario');
            $usuarioFactura = $this->ventas_model->get_factura($idUsuario);
            $pdf = new TCPDF();
        
            // Configurar el documento
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Tu Nombre');
            $pdf->SetTitle('Factura');
            $pdf->SetSubject('Factura PDF');
            $pdf->SetKeywords('Factura, PDF, CodeIgniter');
    
            // Añadir una página
            $pdf->AddPage();
    
            // Agregar contenido al PDF
            $contenido = '<h1>Factura</h1>';
            $contenido .= '<p>Nombre: ' . $usuarioFactura->id . '</p>';
            $contenido .= '<p>Dirección: ' . $usuarioFactura->id_usuario . '</p>';
            // Agrega otros datos a tu gusto
    
            $pdf->writeHTML($contenido, true, false, true, false, '');
    
            // Salida del PDF (puedes elegir descargarlo o mostrarlo en el navegador)
            $pdf->Output('factura.pdf', 'D');
        } */
        
        // En Facturas.php        
        /*public function generarFacturaXML() {
            $idusuario=$this->input->post('id');
            $rfc=$this->input->post('rfc');
            //$this->ventas_model->addrfc($idusuario,$rfc);
            // Llamar al método del modelo para generar el XML
            $contenidoXML = $this->ventas_model->generate_xml($idusuario);
        
            if ($contenidoXML) {
                // Establecer las cabeceras para descargar el archivo
                header('Content-Type: application/xml');
                header('Content-Disposition: attachment; filename="factura.xml"');
        
                // Imprimir directamente el contenido XML sin espacios adicionales
                echo $contenidoXML;
            } else {
                // Manejar el caso en que no se pueda generar la factura XML
                echo "Error al generar la factura XML. Factura no encontrada.";
            }
        }*/
        public function generarFacturaXML() {
            /*$idusuario = $this->input->post('id');
            $rfc = $this->input->post('rfc');
        
            // Elimina cualquier salida no deseada antes de la declaración XML
            ob_clean();
        
            // Llamar al método del modelo para generar el XML
            $contenidoXML = $this->ventas_model->generate_xml($idusuario);
        
            if ($contenidoXML) {
                // Establecer las cabeceras para descargar el archivo
                header('Content-Type: application/xml');
                header('Content-Disposition: attachment; filename="factura.xml"');
        
                // Imprimir directamente el contenido XML sin espacios adicionales
                echo $contenidoXML;
            } else {
                // Manejar el caso en que no se pueda generar la factura XML
                echo "Error al generar la factura XML. Factura no encontrada.";
            }*/
            $fecha=$this->input->post('fecha');
            $idusuario = $this->input->post('id');
            //$rfc = $this->input->post('rfc');
        
            // Elimina cualquier salida no deseada antes de la declaración XML
            ob_clean();
        
            // Llamar al método del modelo para generar el XML
            $contenidoXML = $this->ventas_model->generate_xml($idusuario,$fecha);
        
            if ($contenidoXML) {
                // Establecer las cabeceras para descargar el archivo
                header('Content-Type: application/xml');
                header('Content-Disposition: attachment; filename="factura.xml"');
        
                // Imprimir directamente el contenido XML sin espacios adicionales
                echo $contenidoXML;
            } else {
                // Manejar el caso en que no se pueda generar la factura XML
                echo "Error al generar la factura XML. Factura no encontrada.";
            }
        }
        
        

        
        //CORRECTA
        public function getdeseos( $idusuario){
            $rs=$this->usuarios_model->get_deseos($idusuario);
            $obj['resultado']=$rs!=NULL;
            //$obj['cantidad'] = "Se encontraron " . count($rs) . " compra(s) realizada(s)";
            $obj['lista']=$rs;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);  
        } 
        //CORRECTA
        public function agregadeseo(){
            $id_usuario=$this->input->post('id_usuario');
            $id_vuelo=$this->input->post('id_vuelo');
            $rs=$this->productos_model->exist_wish($id_usuario,$id_vuelo);            
            $result=0;
            if(!$rs){
                $result=$this->usuarios_model->insert_deseo($id_usuario,$id_vuelo);
            }            
            $obj['resultado']=$result!=false;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);  
        }     

        public function addCarrito(){
            $id_usuario=$this->input->post('id_usuario');
            $id_vuelo=$this->input->post('id_vuelo');
            $costo_vuelo=$this->input->post('costo_vuel');
            $cantidad=$this->input->post('cant');
            $exists=$this->productos_model->exists_car($id_usuario,$id_vuelo);   
            $cantActual=$this->productos_model->get_cantCar($id_usuario,$id_vuelo);
            $estatus=$this->productos_model->getEstatus($id_usuario,$id_vuelo);
            $result=0;
            $opc=0;
            if(!$exists || !$result){
                $result=$this->productos_model->add_carrito($id_usuario,$id_vuelo,$costo_vuelo);
            }/*else{
                $tot=$cantidad+$cantActual;
                //echo json_encode($tot);
                $verifica=$this->productos_model->cant_inventario($id_vuelo);
                if($verifica!=NULL && $verifica >= $tot){
                    $result=$this->productos_model->update_car($id_usuario,$id_vuelo,$cantidad,$cantActual);  
                    //echo json_encode($verifica);
                    //echo json_encode($cantActual);
                }
            }*/                
            $obj['resultado']=$result!=0;
            echo json_encode($obj);
        }
        
        public function actulizaCantidad(){
            $id_usu=$this->input->post('id_usuario');
            $id_vuelo=$this->input->post('id_vuelo');
            $cant=$this->input->post('cantidad');
            $total=$this->input->post('total');
            $cantActual=$this->productos_model->cant_inventario($id_vuelo);
            //$obj['usuario']=$id_usu;
            //$obj['vuelo']=$id_vuelo;
            //$obj['cant']=$cant;
            //echo json_encode($cantActual);
            $result=0;
            //echo json_encode($cant);
            if($cantActual >= $cant){
                $result=$this->productos_model->actualizar_cantidad($id_usu,$id_vuelo,$cant,$total);
                //echo json_encode($result);
            }else{
                $result=false;
            }
            $obj['resultado']=$result;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }
        /*public function exists_deseos($idusuario,$id_vuelo){
            $rs=$this->productos_model->exist_wish($idusuario,$id_vuelo);
            if($rs!=1){
                $deseo=$this->usuarios_model->insert_deseo($id_usuario,$id_vuelo);                                
            }
            $obj['resultado']=$rs!=1;            
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }     */
        //CORRECTA
        public function borradeseo(){
            $id=$this->input->post('id');
            $rs=$this->usuarios_model->delete_deseo($id);                                    
            $obj['resultado']=$rs;            
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        } 
        public function borraCarrito(){
            $id=$this->input->post('id');
            $rs=$this->usuarios_model->borra_Carrito($id);                                    
            $obj['resultado']=$rs;            
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }
    }
?>