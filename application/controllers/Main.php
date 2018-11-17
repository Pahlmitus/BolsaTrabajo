<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
                $this->load->helper('url');
                $this->load->library('Grocery_CRUD');
                include_once('utils.php');
        }
	public function index()
	{
                $data = loadBootstrap();
                $data['output'] = "Contingut de la variable <i>output</i>";
                $this->load->view('templates/header', $data);
		$this->load->view('index', $data);
                $this->load->view('templates/footer', $data);
	}
        
        
        /*** GROCERY CRUDs ***/
        public function users()
        {
                $output = createGroceryCRUD('users', 'Usuario', array('user_role_id', 'roles', 'role_id'));
                $this->showGroceryCRUD($output);
        }
        public function companies()
        {
                $output = createGroceryCRUD('companies', 'Empresa', array('company_user_id', 'users', 'user_id'));
                $this->showGroceryCRUD($output);
        }
        public function roles()
        {
                $output = createGroceryCRUD('roles', 'Rol');
                $this->showGroceryCRUD($output);
        }
        
        
        /*** LOGIN I LOGOUT ***/
        public function login() {

            $this->load->model('User_model');
            $auth = $this->User_model->authenticateUser('johndoe@yahoo.com', '1234');
            
            if ($auth === true) {
                $this->session->logged_in = 1;
                $data = loadBootstrap();
                $data['output'] = "Contingut de la variable <i>output</i>";
                $this->load->view('templates/header', $data);
                $this->load->view('index', $data);
                echo "LOGIN OK";
                $this->load->view('templates/footer', $data);
            } else {
                $data = loadBootstrap();
                $data['output'] = "Contingut de la variable <i>output</i>";
                $this->load->view('templates/header', $data);
                $this->load->view('index', $data);
                echo "<h4>EL EMAIL O LA CONTRASEÑA SON INCORRECTOS</h4>";
                $this->load->view('templates/footer', $data);
            }
            
        }
        
        public function logout() {
            $this->session->logged_in = 0;
            $data = loadBootstrap();
            $data['output'] = "Contingut de la variable <i>output</i>";
            $this->load->view('templates/header', $data);
            $this->load->view('index', $data);
            $this->load->view('templates/footer', $data);
        }

        
        /*** Funcions que no poden anar en utils.php perquè utilitzen objectes ***/
        function showGroceryCRUD($output)
        {
            if ($this->session->userdata('logged_in') === 1) {
                $this->load->view('templates/header', $output);
                $this->load->view('grocery_crud_view', $output);
                $this->load->view('templates/footer', $output);
            } else {
                show_404();
            }
        }
}
