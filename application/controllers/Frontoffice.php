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
                        echo '<div class="alert alert-danger" role="alert" id="login_error">
                        <p>!</p>
                        <b>Error:</b> El email o la contraseña son incorrectos.
                        </div>';
                }
                
                // Muestra las últimas ofertas
                $this->load->model('Offer_model');
                $datos['offers'] = $this->Offer_model->getLastFive();
                $datos['title'] = "<h2>Últimas ofertas</h2>";

                // Carga la vista
                $this->load->view('templates/header', $datos);
                $this->load->view('front_view', $datos);
                $this->load->view('templates/footer', $datos);
        }

        // BUSCAR
        public function search($search = "") {
                $datos = array('css_files' => array(), 'js_files' => array());
                $datos = loadMainStyles($datos);
                $datos = loadBootstrap($datos);

                if ($this->session->loggin_err == 1) { 
                        $this->session->loggin_err = 0;
                        echo '<div class="alert alert-danger" role="alert" id="login_error">
                        <p>!</p>
                        <b>Error:</b> El email o la contraseña son incorrectos.
                        </div>';
                }
                
                // Carga las ofertas
                $this->load->model('Offer_model');
                $datos['offers'] = $this->Offer_model->searchAll($search);
                $datos['title'] = "<h4>Mostrando ofertas de " . $search . "</h4>";

                // Carga la vista
                $this->load->view('templates/header', $datos);
                $this->load->view('front_view', $datos);
                $this->load->view('templates/footer', $datos);
        }

        // MOSTRAR POR ETIQUETA(S)
        public function tag($tag = "") {
                $datos = array('css_files' => array(), 'js_files' => array());
                $datos = loadMainStyles($datos);
                $datos = loadBootstrap($datos);

                if ($this->session->loggin_err == 1) { 
                        $this->session->loggin_err = 0;
                        echo '<div class="alert alert-danger" role="alert" id="login_error">
                        <p>!</p>
                        <b>Error:</b> El email o la contraseña son incorrectos.
                        </div>';
                }
                
                // Carga las ofertas
                $this->load->model('Offer_model');
                $datos['offers'] = $this->Offer_model->getByTag($tag);
                $datos['title'] = "<h4>Mostrando ofertas con la etiqueta <i>" . $tag . "</i></h4>";

                // Carga la vista
                $this->load->view('templates/header', $datos);
                $this->load->view('front_view', $datos);
                $this->load->view('templates/footer', $datos);
        }

        // MOSTRAR POR PROVINCIA
        public function location($location = "") {
                $datos = array('css_files' => array(), 'js_files' => array());
                $datos = loadMainStyles($datos);
                $datos = loadBootstrap($datos);

                if ($this->session->loggin_err == 1) { 
                        $this->session->loggin_err = 0;
                        echo '<div class="alert alert-danger" role="alert" id="login_error">
                        <p>!</p>
                        <b>Error:</b> El email o la contraseña son incorrectos.
                        </div>';
                }
                
                // Carga las ofertas
                $this->load->model('Offer_model');
                $datos['offers'] = $this->Offer_model->getByLocation($location);
                $datos['title'] = "<h4>Mostrando ofertas en la provincia de <i>" . $location . "</i></h4>";

                // Carga la vista
                $this->load->view('templates/header', $datos);
                $this->load->view('front_view', $datos);
                $this->load->view('templates/footer', $datos);
        }

        // REGISTRO (parte de frontoffice)
        public function register() {
                // Si ya está registrado, carga el index
                if ($this->session->logged_in !== 1) {
                        $datos = array('css_files' => array(), 'js_files' => array());
                        $datos = loadMainStyles($datos);
                        $datos = loadBootstrap($datos);

                        // Carga la vista
                        $this->load->view('templates/header', $datos);
                        $this->load->view('register_view', $datos);
                        $this->load->view('templates/footer', $datos);
                } else {
                        redirect('/', 'refresh');
                }
        }
}