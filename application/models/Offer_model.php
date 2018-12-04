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

    public function getLastFive() {
        $query = $this->db->query('SELECT * FROM `offers`, `companies` WHERE `offer_company_id` = `company_id` LIMIT 5;');
        return $query->result();
    }
    
    public function getByTag($tag) {
        $query = $this->db->query('SELECT * FROM `offers`, `companies` WHERE `offer_company_id` = `company_id` AND `offer_tags` LIKE "%' . $tag . '%";');
        return $query->result();
    }

    public function getByLocation($location) {
        $query = $this->db->query('SELECT * FROM `offers`, `companies` WHERE `offer_company_id` = `company_id` AND `offer_location` = "' . $location . '";');
        return $query->result();
    }

    public function searchAll($search) {
        $query = $this->db->query("SELECT * FROM `offers`, `companies` WHERE (`offer_company_id` = `company_id`)
         AND (
            (`offer_title` LIKE '%". $search ."%') 
            OR (`offer_description` LIKE '%". $search ."%') 
            OR (`offer_location` LIKE '%". $search ."%') 
            OR (`offer_tags` LIKE '%". $search ."%')
            OR (`company_name` LIKE '%". $search ."%')
            )
         ");
         return $query->result();
    }
}