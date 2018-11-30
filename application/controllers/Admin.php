<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

        public function __construct() {
                parent::__construct();
                $this->load->database();
                $this->load->helper('url');
                $this->load->library('session');
                $this->load->library('Grocery_CRUD');
                include_once('utils.php');
        }
        public function index() {
                $this->showAdmin();
        }
        
        
        /*** GROCERY CRUDs ***/
        public function users() {
                $config = (object) array(
                    'table' => 'users',
                    'subject' => 'Usuario',
                    'columns' => array(
                        'user_firstname' => 'Nombre',
                        'user_lastname' => 'Apellidos',
                        'user_email' => 'Email',
                        'user_passwd' => 'Contraseña',
                        'user_role_id' => 'ID de rol'
                    ),
                    'relations' => array('user_role_id', 'roles', 'role_id'),
                    'password_field' => 'user_passwd'
                );
                $output = createGroceryCRUD($config);
                $this->showGroceryCRUD($output);
        }
        public function companies() {
                $config = (object) array(
                    'table' => 'companies',
                    'subject' => 'Empresa',
                    'columns' => array(
                        'company_name' => 'Nombre',
                        'company_description' => 'Descripción',
                        'company_logo' => 'Logotipo',
                        'company_cif' => 'CIF',
                        'company_city' => 'Ciudad',
                        'company_state' => 'País/Estado',
                        'company_phone' => 'Teléfono',
                        'company_email' => 'Email',
                        'company_web' => 'Sitio web',
                        'company_user_id' => 'ID de propietario'
                    ),
                    'relations' => array('company_user_id', 'users', 'user_id'),
                    'image_field' => array('company_logo', 'assets/company_logos/')
                );
                $output = createGroceryCRUD($config);
                $this->showGroceryCRUD($output);
        }
        public function roles() {
            $config = (object) array(
                'table' => 'roles',
                'subject' => 'Rol',
                'columns' => array(
                    'role_description' => 'Descripción',
                    'role_level' => 'Nivel'
                )
            );
            $output = createGroceryCRUD($config);
            $this->showGroceryCRUD($output);
        }

        public function candidatos() {
            $config = (object) array(
                'table' => 'candidates',
                'subject' => 'Candidato',
                'columns' => array(
                    'candidate_studies_id' => 'ID de estudios',
                    'candidate_birthdate' => 'Fecha de nacimiento',
                    'candidate_phone' => 'Teléfono',
                    'candidate_photo' => 'Foto',
                    'candidate_cv' => 'Currículum',
                    'candidate_user_id' => 'ID de usuario'
                ),
                'relations' => array(
                    array('candidate_studies_id', 'studies', 'studies_id'),
                    array('candidate_user_id', 'users', 'user_id')
                ),
                'image_field' => array('candidate_photo', 'assets/candidate_photos/'),
                'pdf_field' => array('candidate_cv', 'assets/candidate_cvs/')
            );
            $output = createGroceryCRUD($config);
            $this->showGroceryCRUD($output);
        }

        
        /*** Funciones que no pueden ir en utils.php porque utilizan objetos ***/
        function showGroceryCRUD($output) {
                if (($this->session->userdata('logged_in') === 1) && ($this->session->userdata('user_role_id') == 1)) {
                    $output = loadMainStyles($output);

                    $this->load->view('templates/header', $output);
                    $this->load->view('grocery_crud_view', $output);
                    $this->load->view('templates/footer', $output);
                } else {
                    show_404();
                }
        }

        function showAdmin($logged_error = NULL) {
                if (($this->session->userdata('logged_in') === 1) && ($this->session->userdata('user_role_id') == 1)) {
                        $datos = array('css_files' => array(), 'js_files' => array());
                        $datos = loadMainStyles($datos);
                        $datos = loadBootstrap($datos);
                        if ($logged_error == 1) {
                            echo '<div class="alert alert-danger" role="alert">
                            <b>Error:</b> El email o contraseña son incorrectos.
                            </div>';
                        }
                        $this->load->view('templates/header', $datos);
                        $this->load->view('admin_view', $datos);
                        $this->load->view('templates/footer', $datos);
                } else {
                    show_404();
                }
        }
}
