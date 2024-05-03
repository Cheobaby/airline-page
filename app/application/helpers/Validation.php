<?php

class Validation extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Cargar el sistema de sesiones si no se ha cargado automáticamente
        $this->load->library('session');
    }

    public function __validar() {
        if (!$this->session->userdata('user')) {
            redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
        }
    }
}
