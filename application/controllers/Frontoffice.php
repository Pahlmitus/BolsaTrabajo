<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontoffice extends CI_Controller {
        public function __construct() {
                parent::__construct();
                $this->load->database();
                $this->load->helper('url');
                $this->load->library('session');
                $this->load->library('Grocery_CRUD');
                $this->load->library('pagination');
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
                $datos['offers'] = $this->Offer_model->getLastThree();
                $datos['title'] = "<h2>Últimas ofertas</h2>
                <a href='" . base_url('/all') . "'><small>Ver todas las ofertas</small></a>";

                // Carga la vista
                $this->load->view('templates/header', $datos);
                $this->load->view('front_view', $datos);
                $this->load->view('templates/footer', $datos);
        }

        // MOSTRAR TODAS
        public function all() {
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
                
                // Selecciona todas las ofertas

                $this->load->model('Offer_model');
                // $datos['offers'] = $this->Offer_model->getAll();
                $datos['title'] = "<h2>Todas las ofertas</h2>";

                // PAGINACIÓN
                $config["total_rows"] = $this->Offer_model->countAll();
                $config["base_url"] = base_url() . "/all";
                $config["per_page"] = 2;
                $config["uri_segment"] = 3;

                $this->pagination->initialize($config);

                $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
                $datos["offers"] = $this->Offer_model->fetchOffers($page, 2);
                $datos["links"] = $this->pagination->create_links();

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
        public function tag($tags = "") {
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
                $datos['offers'] = $this->Offer_model->getByTag($tags);

                if (strpos($tags, '+') !== false) {
                        $title = "<h4>Mostrando ofertas con las etiquetas <i>";
                        $tags = explode("+", $tags);
                        foreach ($tags as $tag) {
                            $title = $title . $tag . ", ";
                        }
                        $title = substr($title, 0, -2);
                        $title = $title . "</i></h4>";
                        $datos['title'] = $title;
                } else {
                        $datos['title'] = "<h4>Mostrando ofertas con la etiqueta <i>" . $tags . "</i></h4>";
                }

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


        // MOSTRAR CANDIDATOS
        public function candidates() {
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
                
                // Selecciona todos los candidatos
                $this->load->model('Candidate_model');
                $datos['title'] = "<h2>Mostrando todos los candidatos</h2>
                <small>Para no herir la sensibilidad de nuestros estimados y muy preparados candidatos, 
                no está permitido el filtrado por edad, raza, género, o estudios.<br/> En <b>Bolsa
                de Trabajo</b> estamos profundamente en contra de la <u>discriminación</u> y creemos 
                que todos merecemos una oportunidad.</small>";

                // PAGINACIÓN
                $config["total_rows"] = $this->Candidate_model->countAll();
                $config["base_url"] = base_url() . "/all";
                $config["per_page"] = 2;
                $config["uri_segment"] = 3;

                $this->pagination->initialize($config);

                $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
                $datos["candidates"] = $this->Candidate_model->fetchCandidates($page, 2);

                // Añade los datos de usuarios asignados a los candidatos
                $this->load->model("User_model");
                foreach ($datos["candidates"] as $candidate) {
                        $user = $this->User_model->getUserById($candidate->candidate_user_id);
                        $candidate->user_firstname = $user[0]->user_firstname;
                        $candidate->user_lastname = $user[0]->user_lastname;
                        $candidate->user_email = $user[0]->user_email;
                } 

                $datos["links"] = $this->pagination->create_links();

                // Carga la vista
                $this->load->view('templates/header', $datos);
                $this->load->view('candidates_view', $datos);
                $this->load->view('templates/footer', $datos);
        }

        public function profile($id) {
                if (isset($id)) {
                        $datos = array('css_files' => array(), 'js_files' => array());
                        $datos = loadMainStyles($datos);
                        $datos = loadBootstrap($datos);

                        $this->load->model("User_model");
                        $datos['user'] = $this->User_model->getUserById($id);
                        
                        $this->load->model("Candidate_model");
                        $datos['candidate'] = $this->Candidate_model->getCandidateByUserId($id);

                        $this->load->model("Studies_model");
                        $datos['studies'] = $this->Studies_model->getStudiesById($datos['candidate'][0]->candidate_studies_id);

                        $this->load->view('templates/header', $datos);
                        $this->load->view('back_view', $datos);
                        $this->load->view('templates/footer', $datos);
                } else {
                        redirect('/candidates', 'refresh');
                }
        }
}