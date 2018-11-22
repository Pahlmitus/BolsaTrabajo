<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {
        public function __construct() {
                parent::__construct();
                $this->load->database();
                $this->load->helper('url');
                $this->load->library('Grocery_CRUD');
                include_once('utils.php');
        }
        
        public function index() {
            $this->showIndex();
        }

        /*** LOGIN Y LOGOUT ***/
        public function login() {
            // Comprueba si el usuario ya ha iniciado la sesión
            if (($this->session->logged_in !== 1) && isset($_POST['user_email'])) {
                $this->load->model('User_model');
                $user_email = $_POST['user_email'];
                $user_passwd = $_POST['user_passwd'];
                $user = $this->User_model->authenticateUser($user_email, $user_passwd);
            
                if ($user !== false) {
                    // Login correcto
                    $this->session->logged_in = 1;

                    // Carga los datos del usuario en variables de sesión
                    $this->session->user_firstname = $user[0]->user_firstname;
                    $this->session->user_id = $user[0]->user_id;
                    $this->session->user_role_id = $user[0]->user_role_id;

                    // Muestra la página principal
                    $this->showIndex();

                } else {
                    // Muestra "Login incorrecto" y la página principal
                    $this->showIndex(1);
                }
            } else {
                $this->showIndex();
            }
        }
        
        public function logout() {
            if ($this->session->logged_in !== 0) {
                $this->session->logged_in = 0;
                $this->showIndex();
            } else {
                $this->showIndex();
            }
        }

        public function showIndex($logged_error = NULL) {
                if ($this->session->logged_in !== 0) {
                        $datos = array('css_files' => array(), 'js_files' => array());
                        $datos = loadMainStyles($datos);
                        $datos = loadBootstrap($datos);
                        if ($logged_error == 1) {
                            echo '<div class="alert alert-danger" role="alert">
                            <b>Error:</b> El email o contraseña son incorrectos.
                            </div>';
                        }
                        $this->load->view('templates/header', $datos);
                        $this->load->view('back_view', $datos);
                        $this->load->view('templates/footer', $datos);
                } else {
                        show_404();
                }
        }
        
}