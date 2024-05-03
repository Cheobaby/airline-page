<?php
    class Usuarios extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('usuarios_model');
            $this->load->model('productos_model');
            $this->load->library('session');
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, OPTIONS");
        }

        public function buscarvuelo($item) {
            $result = $this->productos_model->buscar_vuelo($item);
            $obj['resultado'] = $result != NULL;
            $obj['datos'] = $result;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }
        public function getpaisesfiltrar(){
            $result=$this->productos_model->get_paises();
            $obj['resultado']=$result;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }
        public function get_productos(){
            $this->load->model('productos_model');
            $result=$this->productos_model->get_productos();
            $obj['resultado']=$result!=NULL;
            $obj['mensaje']='Se econtraron '.count($result).' productos';
            $obj['productos']=$result;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);            
            //print_r($result);            
        }
        /*public function insertar(){
            $this->load->model('usuarios_model');  
            $result=$this->usuarios_model->insert_usuario(array(
                'nombre' => $nombre,
                'correo' => $correo,
                'pass'   => $pass,
            ));
            $obj['resultado']=$result!=NULL;
            $obj['contenido']=$result;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);           

        }*/  
        /*      
        public function registrausuario(){
            $this->load->model('usuarios_model');  
            $result=$this->usuarios_model->insert_usuario(array(
                'nombre_usuario' => 'JUAN ESCALONA',
                'correo_usu' => 'PACO MEMO',
                'contraseña_usuario'   => '123',
            ));
            $obj['resultado']=$result!=-1;
            $obj['id']=$result;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);   
        }*/
        //correcta
        public function getcliente($idusuario){            
            $result = $this->usuarios_model->get_cliente($idusuario);
            $obj['resultado'] = $result != NULL;
            $obj['data'] = $result;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }
        
        //correcta
        public function registrausuario() {
            // Recupera los datos del formulario usando input->post
            $nombre = $this->input->post('nombre');
            $email = $this->input->post('email');
            $contrasena = $this->input->post('contrasena');
            $direccion=$this->input->post('direccion');
            $telefono=$this->input->post('telefono');
    
            // Carga el modelo y realiza la inserción
            $this->load->model('usuarios_model');
            $result = $this->usuarios_model->insert_usuario(array(
                'nombre' => $nombre,
                'email' => $email,
                'contrasena' => $contrasena,
                'direccion' => $direccion,
                'telefono' => $telefono,

            ));
    
            // Prepara la respuesta JSON
            $obj['resultado'] = $result != -1;
            $obj['id'] = $result;
    
            // Establece el tipo de contenido y envía la respuesta JSON
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }  
        //correcta    
        /*public function acceso() {
            $correo = $this->input->post('correo');
            $contra = $this->input->post('pass');
    
            $result = $this->usuarios_model->acceso_usuario($correo, $contra);
    
            $obj['resultado'] = $result != NULL;
            $obj['data'] = $result;            
            $this->output->set_content_type('application/json');
            echo json_encode($obj);          
        }*/
        public function acceso() {
            $correo = $this->input->post('correo');
            $contra = $this->input->post('pass');
        
            $result = $this->usuarios_model->acceso_usuario($correo, $contra);
            $response=array();
            if($result!=NULL){
                $user=array(
                    'id'   =>$result->id,
                    'nombre'   =>$result->nombre, 
                    'email'   =>$result->email, 
                    'contrasena'   =>$result->contrasena, 
                    'direccion'   =>$result->direccion, 
                    'telefono'   =>$result->telefono
                );
                $this->session->set_userdata('user',$user);
            }
            $obj['resultado'] = $result != NULL;
            $obj['data'] = $result;
        
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        
            // Verificar si el resultado es true y almacenar en una variable de sesión
            /*if ($obj['resultado']) {
                $this->session->set_userdata('user', $obj);
            }*/
        }
        

        //correcta
        public function actualizaperfil(){
            $id = $this->input->post('id');
            $nombre = $this->input->post('nombre');
            $email = $this->input->post('email');
            $contrasena = $this->input->post('contrasena');
            $direccion = $this->input->post('direccion');
            $telefono = $this->input->post('telefono');
        
            $result = $this->usuarios_model->update_usuario(array(
                'id' => $id,
                'nombre' => $nombre,
                'email' => $email,
                'contrasena' => $contrasena,
                'direccion' => $direccion,
                'telefono' => $telefono
            ));        
            $obj['operacion'] = $result;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }
        //CORRECTA
        public function actualiza_pasajero(){
            $id=$this->input->post('id');
            $nombre=$this->input->post('nombre'); 
            $numero_pasaporte=$this->input->post('numero_pasaporte'); 
            $fecha_nacimiento=$this->input->post('fecha_nacimiento');

            $rs=$this->usuarios_model->update_cliente(array(
                'id' => $id,
                'nombre' => $nombre,
                'numero_pasaporte' => $numero_pasaporte,
                'fecha_nacimiento' => $fecha_nacimiento         
            ));
            $obj['operacion']=$rs;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }
        public function getproductosporpais(){
            $id_pais=$this->input->post('pais');
            $result=$this->productos_model->get_productos_por_pais($id_pais);
            $obj['resultado']=$result;
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }

    }
?>