<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {
        public function __construct() {
                parent::__construct();
                $this->load->database();
                $this->load->helper('url');
                $this->load->library('session');
                $this->load->library('Grocery_CRUD');
                include_once('utils.php');
        }
        
        public function index() {
            // Los administradores no tienen página personal, sólo la vista principal del panel de control
            if (($this->session->userdata('logged_in') === 1) && ($this->session->userdata('user_role_id') == 1)) {
                redirect('/admin/users', 'refresh');
            } else {
                $this->showIndex();
            }
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
                    //$this->showIndex();
                    redirect('/', 'refresh');

                } else {
                    // Muestra "Login incorrecto" y la página principal
                    $this->session->loggin_err = 1;
                    redirect('/', 'refresh');
                }
            } else {
                redirect('/', 'refresh');
            }
        }
        
        public function logout() {
                if ($this->session->logged_in !== 0) {
                        $this->session->logged_in = 0;
                        redirect('/', 'refresh');
                } else {
                        redirect('/', 'refresh');
                }
        }

        /*** REGISTRO (despúes de introducir los datos en Frontoffice) ***/

        public function registerTrabajador() {
                // Quitamos el modo debug de las bases de datos para que no nos dé problemas
                $db_debug = $this->db->db_debug;
                $this->db->db_debug = FALSE;
                
                $trabajador = array(
                        $this->input->post('trabajador_firstname'),
                        $this->input->post('trabajador_lastname'),
                        $this->input->post('trabajador_email'),
                        $this->input->post('trabajador_passwd')
                );
                $sql = "INSERT INTO users (`user_firstname`, `user_lastname`, `user_email`, `user_passwd`, `user_role_id`)
                VALUES (?, ?, ?, ?, 2);";
                if ($this->db->query($sql, $trabajador)) {
                    redirect('/', 'refresh');
                }
                $error = $this->db->error();
                if ($error) {
                    redirect('/register?err=1', 'refresh');
                }
                
                // ...y lo dejamos como estaba
                $this->db->db_debug = $db_debug;
  
        }

        public function registerEmpresario() {
            // Quitamos el modo debug de las bases de datos para que no nos dé problemas
            $db_debug = $this->db->db_debug;
            $this->db->db_debug = FALSE;
            
            $empresario = array(
                    $this->input->post('empresario_firstname'),
                    $this->input->post('empresario_lastname'),
                    $this->input->post('empresario_email'),
                    $this->input->post('empresario_passwd')
            );
            $company = array($this->input->post('empresario_company'));

            $sql = "INSERT INTO users (`user_firstname`, `user_lastname`, `user_email`, `user_passwd`, `user_role_id`)
            VALUES (?, ?, ?, ?, 2);";
            if ($this->db->query($sql, $empresario)) {
                $this->session->company_name = $company;
                redirect(base_url('/register/empresa'), 'refresh');
            }
            $error = $this->db->error();
            if ($error) {
                redirect('/register?err=1', 'refresh');
                print_r($error);
            }
            
            // ...y lo dejamos como estaba
            $this->db->db_debug = $db_debug;

        }

        public function registerEmpresa() {
            // Quitamos el modo debug de las bases de datos para que no nos dé problemas
            $db_debug = $this->db->db_debug;
            $this->db->db_debug = FALSE;
            
            $empresario = array(
                    $this->input->post('empresario_firstname'),
                    $this->input->post('empresario_lastname'),
                    $this->input->post('empresario_email'),
                    $this->input->post('empresario_passwd')
            );
            $company = array($this->input->post('empresario_company'));

            $sql = "INSERT INTO users (`user_firstname`, `user_lastname`, `user_email`, `user_passwd`, `user_role_id`)
            VALUES (?, ?, ?, ?, 2);";
            if ($this->db->query($sql, $empresario)) {
                $this->session->company_name = $company;
                redirect(base_url('/registerEmpresa'), 'refresh');
            }
            $error = $this->db->error();
            if ($error) {
                redirect('/register?err=1', 'refresh');
                print_r($error);
            }
            
            // ...y lo dejamos como estaba
            $this->db->db_debug = $db_debug;

        }

        public function showIndex($logged_error = NULL) {
                if ($this->session->logged_in !== 0) {
                    // Si está registrado Y no es administrador, muestra el perfil del usuario
                        if ($this->session->user_role_id !== 1) {
                                $datos = array('css_files' => array(), 'js_files' => array());
                                $datos = loadMainStyles($datos);
                                $datos = loadBootstrap($datos);

                                $this->load->model("User_model");
                                $datos['user'] = $this->User_model->getUserById($this->session->user_id);
                                
                                $this->load->model("Candidate_model");
                                $datos['candidate'] = $this->Candidate_model->getCandidateByUserId($this->session->user_id);

                                $this->load->model("Studies_model");
                                $datos['studies'] = $this->Studies_model->getStudiesById($datos['candidate'][0]->candidate_studies_id);

                                if ($logged_error == 1) {
                                    echo '<div id="login_error" class="alert alert-danger" role="alert">
                                    <b>Error:</b> El email o contraseña son incorrectos.
                                    </div>';
                                }
                                $this->load->view('templates/header', $datos);
                                $this->load->view('back_view', $datos);
                                $this->load->view('templates/footer', $datos);
                        } else {
                            redirect('/admin/users', 'refresh');
                        }
                } else {
                    show_404();
                }
        }
        
}