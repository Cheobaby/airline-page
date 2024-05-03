<?php

class Acceso extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        //$this->load->model('../webservice/Usuarios_model');
        $this->load->library('session');        
    }
    public function otroMetodo() {
        // Acceder a los valores del arreglo de sesión 'user'
        $userData = $this->session->userdata('user');
    
        // Verificar si el arreglo de sesión 'user' existe y contiene datos
        if (!empty($userData)) {
            // Acceder a los valores individuales del arreglo
            $id = $userData['id'];
            $nombre = $userData['nombre'];
            $email = $userData['email'];
    
            // Puedes utilizar estos valores en tu lógica
            echo "ID: $id, Nombre: $nombre, Email: $email";
        } else {
            // El arreglo de sesión 'user' no existe o está vacío
            echo "El arreglo de sesión 'user' no está disponible.";
        }
    }
    
    public function cierrasesion() {
        // En tu controlador o en cualquier lugar donde desees destruir la sesión
        $this->session->sess_destroy();        
        redirect('frontend/login');
    }

    public function login($ruta) {
        // Página de inicio de sesión
        $this->load->view($ruta);
    }
}

?>