<?php

class Offer_model extends CI_Model {

    private $offer_id;
    private $offer_title;
    private $offer_description;
    private $offer_date;

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $query = $this->db->query('SELECT * FROM `offers`, `companies` WHERE `offer_company_id` = `company_id`;');
        return $query->result();
    }
    
}