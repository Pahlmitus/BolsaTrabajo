<?php

class Studies_model extends CI_Model {

    private $studies_id;
    private $studies_level;
    private $studies_description;

    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $query = $this->db->get('studies');
        return $query->result();
    }
    
    public function getStudiesById($studies_id) {
        $query = $this->db->query('SELECT * FROM `studies` WHERE `studies_id` = ' . $studies_id);
        return $query->result();
    }
}
