<?php

class User_model extends CI_Model {
    private $user_id;
    private $user_firstname;
    private $user_lastname;
    private $email;
    private $passwd;
    private $user_role_id;
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $query = $this->db->get('users');
        return $query->result();
    }
    
    public function getUserById($user_id) {
        $query = $this->db->query('SELECT * FROM `users` WHERE `user_id` = ' . $user_id);
        return $query->result();
    }
    
    public function authenticateUser($user_email, $user_passwd) {
        $query = $this->db->query("SELECT * FROM `users` WHERE `user_email` = '" . $user_email . "'");
        if ($query === true) {
            return true;
        } else {
            return false;
        }
    }
}
