<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_matiere extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->table = "matiere";
	}

	public function get_all()
	{
		return $this->db->get($this->table);
	}

	function insert($nom, $emplacement, $capacite){
		$data = array(
			"Nom" => $nom,
			"Emplacement" => $emplacement,
			"Capacite" => $capacite
		);

		return $this->db->insert($this->table, $data);
	}

}