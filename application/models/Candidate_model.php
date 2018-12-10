<?php

class Candidate_model extends CI_Model {

    private $candidate_id;
    private $candidate_studies_id;
    private $candidate_birthdate;
    private $candidate_phone;
    private $candidate_photo;
    private $candidate_cv;
    private $candidate_user_id;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $query = $this->db->get('candidates');
        return $query->result();
    }
    
    public function getCandidateById($candidate_id) {
        $query = $this->db->query('SELECT * FROM `candidates` WHERE `candidate_id` = ' . $candidate_id);
        return $query->result();
    }

    public function getCandidateByUserId($user_id) {
        $query = $this->db->query('SELECT * FROM `candidates` WHERE `candidate_user_id` = ' . $user_id);
        return $query->result();
    }

    // PAGINACIÓN (igual que en ofertas)
    public function countAll() {
        return $this->db->count_all("candidates");
    }
    public function fetchCandidates($start, $limit) {
        $query = $this->db->query('SELECT * FROM `candidates` LIMIT ' . $start . ',' . $limit);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
}
