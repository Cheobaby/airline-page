<?php
    class Frontend extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->library('session');
        }
        public function index() {      
            if (!$this->session->userdata('user')) {
                redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
            }else{
                $this->load->view("index");
            }                        
            
        }
        public function category(){
            if (!$this->session->userdata('user')) {
                redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
            }else{
                $this->load->view('category');
            }           
        }
        public function confirmation(){
            if (!$this->session->userdata('user')) {
                redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
            }   
            $this->load->view('confirmation');
        }
        public function login(){  
            $this->load->view('login');
        }
        public function checkout(){
            if (!$this->session->userdata('user')) {
                redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
            }   
            $this->load->view('checkout');
        }
        public function cart(){
            if (!$this->session->userdata('user')) {
                redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
            }   
            $this->load->view('cart');
        }
        public function create_account(){ 
            $this->load->view('create_account');
        }
        public function lista_deseos(){
            if (!$this->session->userdata('user')) {
                redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
            }else{
                $this->load->view('lista_deseos');
            }            
        }
        public function compras(){
            if (!$this->session->userdata('user')){
                redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
            }else{
                $this->load->view('compras');
            }            
        }
        public function catalogo(){
            if (!$this->session->userdata('user')) {
                redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
            }else{
                if (!$this->session->userdata('user')) {
                redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
            }   
                $this->load->view('catalogo');
            }            
        }
        public function carro(){
            if (!$this->session->userdata('user')) {
                redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
            }   
            $this->load->view('cart');
        }
        public function pagoExitoso(){
            if (!$this->session->userdata('user')) {
                redirect(base_url('frontend/login')); // Redirige al controlador o ruta que maneje el inicio de sesión
            }   
            $this->load->view('pago');
        }
    }    
?>