<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontoffice extends CI_Controller {
        public function __construct() {
                parent::__construct();
                $this->load->database();
                $this->load->helper('url');
                $this->load->library('session');
                $this->load->library('Grocery_CRUD');
                include_once('utils.php');
        }
        
        public function index() {
                $this->showIndex();
        }

        public function showIndex() {
                $datos = array('css_files' => array(), 'js_files' => array());
                $datos = loadMainStyles($datos);
                $datos = loadBootstrap($datos);
                if ($this->session->loggin_err == 1) {
                        $this->session->loggin_err = 0;
                        echo '<div class="alert alert-danger" role="alert">
                        <b>Error:</b> El email o contraseña son incorrectos.
                        </div>';
                }
                
                // Muestra las últimas ofertas
                $this->load->model('Offer_model');
                $datos['offers'] = $this->Offer_model->getAll();

                // Carga la vista
                $this->load->view('templates/header', $datos);
                $this->load->view('front_view', $datos);
                $this->load->view('templates/footer', $datos);
        }
}