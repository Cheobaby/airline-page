<?php
    /*class Usuarios extends CI_Controller{
        public function __construct(){
            $this->load->model('usuarios_model');
        }
        public function registrausuario() {
            // Recupera los datos del formulario usando input->post
            $nombre_usuario = $this->input->post('nombre_usuario');
            $correo_usu = $this->input->post('correo_usu');
            $contraseña_usuario = $this->input->post('contraseña_usuario');
    
            // Carga el modelo y realiza la inserción
            $this->load->model('usuarios_model');
            $result = $this->usuarios_model->insert_usuario(array(
                'nombre_usuario' => $nombre_usuario,
                'correo_usu' => $correo_usu,
                'contraseña_usuario' => $contraseña_usuario,
            ));
    
            // Prepara la respuesta JSON
            $obj['resultado'] = $result != -1;
            $obj['id'] = $result;
    
            // Establece el tipo de contenido y envía la respuesta JSON
            $this->output->set_content_type('application/json');
            echo json_encode($obj);
        }
        
    }*/
    // Archivo: application/controllers/Usuarios.php

// Archivo: application/controllers/backend/Usuarios.php

class Usuarios01 extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        $this->load->model('Usuarios_model');
        $this->load->library('session');
    }
    public function hola(){
        echo "ESTAS EN HOLA";
    }

    public function acceso($correo, $contra) {
        // Obtener datos de formulario y realizar la autenticación
        // ...

        // Iniciar sesión
        $usuario = $this->Usuarios_model->acceso_usuario($correo, $contra);

        if ($usuario) {
            $this->iniciosesion($usuario->id, $usuario->nombre, $usuario->correo);
            echo $usuario;
        } else {
            // Manejar error de credenciales inválidas
            redirect('login/error');
        }
    }

    public function registrausuario($formdata) {
        // Registrar un nuevo usuario
        // ...

        // Obtener el ID del nuevo usuario registrado
        $idusuario = $this->Usuarios_model->insert_usuario($formdata);

        // Iniciar sesión con los datos del nuevo usuario
        $this->iniciosesion($idusuario, $formdata['nombre'], $formdata['correo']);
    }

    public function getcliente($idusuario) {
        // Obtener detalles del cliente (requiere autenticación)
        $data['cliente'] = $this->Usuarios_model->get_cliente($idusuario);

        // Mostrar los detalles del cliente
        $this->load->view('detalles_cliente', $data);
    }

    public function actualizaperfil($formdata) {
        // Actualizar el perfil del usuario (requiere autenticación)
        // ...

        // Redirigir a la página de perfil actualizado
        redirect('perfil');
    }

    // Método privado para iniciar sesión
    private function iniciosesion($idusuario, $nombre, $correo) {
        $this->session->set_userdata('usuario_id', $idusuario);
        $this->session->set_userdata('usuario_nombre', $nombre);
        $this->session->set_userdata('usuario_correo', $correo);
        redirect('inicio');
    }
}


?>