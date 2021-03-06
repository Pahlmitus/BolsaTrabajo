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

    // PAGINACIÓN
    public function countAll() {
        return $this->db->count_all("offers");
    }
    public function fetchOffers($start, $limit) {
        $query = $this->db->query('SELECT * FROM `offers`, `companies` WHERE `offer_company_id` = `company_id` LIMIT ' . $start . ',' . $limit);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function getLastThree() {
        $query = $this->db->query('SELECT * FROM `offers`, `companies` WHERE `offer_company_id` = `company_id` LIMIT 3;');
        return $query->result();
    }
    
    public function getByTag($tags) {
        // Si hay más de una
        if (strpos($tags, '+') !== false) {
            $tagQuery = "";
            $tags = explode("+", $tags);
            foreach ($tags as $tag) {
                $tagQuery = $tagQuery . 'AND `offer_tags` LIKE "%' . $tag . '%"';
            }
            $query = $this->db->query('SELECT * FROM `offers`, `companies` WHERE `offer_company_id` = `company_id` ' . $tagQuery);
            return $query->result();
        } else {
            $query = $this->db->query('SELECT * FROM `offers`, `companies` WHERE `offer_company_id` = `company_id` AND `offer_tags` LIKE "%' . $tags . '%"');
            return $query->result();
        }
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