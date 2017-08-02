<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_cours extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->table = "cours";
	}

	public function get_cours_by_filiere($id)
	{
		return $this->db->query("SELECT c.IDMatiere, c.IDFiliere, m.libelle, e.Nom, e.Prenom, f.Libelle, f.ID FROM cours c, matiere m, enseignant e, filiere f WHERE c.IDMatiere=m.ID AND c.IDFiliere=f.ID AND m.IDEnseignant=e.ID AND f.Libelle='".$id."'");
	}

	public function getTimetable($date){
		return $this->db->query('SELECT * FROM `timetable` WHERE DateCours='.$date);
	}

	public function checkIfTimeIsAvailable($date, $heure, $salle){
		return $this->db->query('SELECT * FROM `timetable` WHERE DateCours="'.$date.'" AND ("'.$heure.'">HeureDebut AND "'.$heure.'"<HeureFin) AND IDSalle="'.$salle.'"');
	}


		// MODEL INSERT USER
	function insertUser($first, $last, $phone, $password){
		$data = array(
			"firstName" => $first,
			"lastName" => $last,
			"phoneNumber" => $phone,
			"password" => $password
		);

		return $this->db->insert($this->table, $data);
	}

	function userConnect($phone, $mdp){
		return $this->db->query("SELECT * FROM users WHERE phoneNumber='".$phone."' AND password='".$mdp."'");
	}

/*
	function get_questions()
	{
		return $this->db->query("SELECT q.idQuestion, q.question, q.idAnswer, q.idAdvertiser, a.firstAnswer, a.secondAnswer, a.rightAnswer FROM questions q, answers a WHERE q.idAnswer=a.idAnswer");
	}

	function get_question_by_ID($id){
		return $this->db->query("SELECT q.idQuestion, q.question, q.idAnswer, q.idAdvertiser, a.firstAnswer, a.secondAnswer, a.rightAnswer FROM questions q, answers a WHERE q.idAnswer=a.idAnswer AND q.idQuestion=".$id);
	}

	function update_uestion($id, $question){
		$data = array(
			"question" => $question
			);

		$this->db->where("idQuestion", $id)
		->update('questions', $data);
	}

	function insertQuestion($question, $idAnswer, $idAdvertiser){
		$data = array(
			"question" => $question,
			"idAnswer" => $idAnswer,
			"idAdvertiser" => $idAdvertiser
		);

		return $this->db->insert($this->table, $data);
	}

	function insertAnswers($firstAnswer, $secondAnswer, $rightAnswer){
		$data = array(
			"firstAnswer" => $firstAnswer,
			"secondAnswer" => $secondAnswer,
			"rightAnswer" => $rightAnswer
		);

		return $this->db->insert("answers", $data);
	}


	// EXO GET ANSWER ID


	function get_answer_by_ID($id)
	{
		return $this->db->query("SELECT a.idAnswer, a.firstAnswer, a.secondAnswer, a.rightAnswer, q.question, q.idQuestion FROM questions q, answers a WHERE a.idAnswer=q.idAnswer AND a.idAnswer=".$id);
	}

	function updateAnswer($id, $first, $second, $right){
		$data = array(
			"firstAnswer" => $first,
			"secondAnswer" => $second,
			"rightAnswer" => $right,
			);

		$this->db->where("idAnswer", $id)
		->update($this->table, $data);
	}


	function get_answer_by_ID($id){
		return $this->db->query("SELECT q.idQuestion, q.question, q.idAnswer, q.idAdvertiser, a.firstAnswer, a.secondAnswer, a.rightAnswer FROM questions q, answers a WHERE q.idAnswer=a.idAnswer AND a.idAnswer=".$id);
	}

	function count_answer(){
		return $this->db->query('SELECT COUNT(*) FROM answers');
	}*/
}

	
