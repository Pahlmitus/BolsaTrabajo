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
        $query = $this->db->get('offers');
        return $query->result();
    }
}