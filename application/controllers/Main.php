<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
        
        
        /*** GROCERY CRUDs ***/
        public function users() {
                $output = createGroceryCRUD('users', 'Usuario', array('user_role_id', 'roles', 'role_id'));
                $this->showGroceryCRUD($output);
        }
        public function companies() {
                $output = createGroceryCRUD('companies', 'Empresa', array('company_user_id', 'users', 'user_id'));
                $this->showGroceryCRUD($output);
        }
        public function roles() {
                $output = createGroceryCRUD('roles', 'Rol');
                $this->showGroceryCRUD($output);
        }
        
        
        /*** LOGIN Y LOGOUT ***/
        public function login() {
            // Comprueba si el usuario ya ha iniciado la sesión
            if ($this->session->logged_in !== 1) {
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

                    // Muestra la página principal
                    echo $this->session->user_firstname . "<br>";
                    echo $this->session->user_id . "<br>";
                    echo password_hash($this->session->user_firstname, PASSWORD_DEFAULT);
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

        
        /*** Funciones que no pueden ir en utils.php porque utilizan objetos ***/
        function showGroceryCRUD($output) {
            if ($this->session->userdata('logged_in') === 1) {
                $output = loadMainStyles($output);

                $this->load->view('templates/header', $output);
                $this->load->view('grocery_crud_view', $output);
                $this->load->view('templates/footer', $output);
            } else {
                show_404();
            }
        }

        function showIndex($logged_error = NULL) {
            $style = array('css_files' => array(), 'js_files' => array());
            $style = loadMainStyles($style);
            $style = loadBootstrap($style);
            $output = "Contingut de la variable <i>output</i>";
            if ($logged_error == 1) {
                echo '<div class="alert alert-danger" role="alert">
                <b>Error:</b> El email o contraseña son incorrectos.
                </div>';
            }
            $this->load->view('templates/header', $style);
            $this->load->view('index', $style);
            $this->load->view('templates/footer', $style);
        }
}
