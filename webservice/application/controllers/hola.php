<?php
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

    }

    public function do_login() {
        $username = $this->input->post('usuario');
        $password = $this->input->post('contra');
    
        $user = $this->login_model->get_user($username, $password);
    
        $response = array();
    
        if ($user) {
            $user_data = array(
                'user_id' => $user->id_usuario,
                'nombre' => $user->nombre,
                'appaterno' => $user->appaterno,
                'apmaterno' => $user->apmaterno,
                'telefono' => $user->telefono,
                'edad' => $user->edad,
                'usuario' => $user->usuario,
                'contra' => $user->contra,   

                'logged_in' => TRUE
            );
            $this->session->set_userdata($user_data);
            $response['success'] = true;
        } else {
            $this->session->set_flashdata('error', 'Usuario o contraseña incorrectos');
            $response['success'] = false;
        }
    
        // Devolver la respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    public function logout() {
        $this->session->sess_destroy();
    
        $response['success'] = true;
    
        // Devolver la respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
}
?>