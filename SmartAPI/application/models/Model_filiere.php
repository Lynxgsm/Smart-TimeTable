<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_filiere extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->table = "filiere";
	}

	public function get_all()
	{
		return $this->db->get($this->table);
	}

	public function getFilieresByAnnee($annee){
		return $this->db->query('SELECT libelle, ID, effectif FROM filiere WHERE Annee='.$annee);
	}

	function insert($libelle, $annee){
		$data = array(
			"Libelle" => $libelle,
			"Annee" => $annee
		);

		return $this->db->insert($this->table, $data);
	}

	function get_etudiants_count(){
		return $this->db->query('SELECT * FROM filiere');
	}

	function get_cours_by_filiere($filiere){
		return $this->db->query('SELECT f.ID, m.Libelle, m.ID AS matiere FROM matiere m, filiere f, cours c WHERE c.IDMatiere=m.ID AND c.IDFiliere=f.ID AND f.ID="'.$filiere.'"');
	}

}