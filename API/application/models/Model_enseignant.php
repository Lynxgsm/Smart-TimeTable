<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_enseignant extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->table = "enseignant";
	}

	public function get_all()
	{
		return $this->db->get($this->table);
	}

	public function countDuration($id){
		return $this->db->query('SELECT SUM(duration) AS SOMME FROM circuitorder WHERE IDCircuit='.$id);
	}

	public function get_all_villes()
	{
		return $this->db->query("SELECT * FROM ville");
	}

	function insert($nom, $prenom, $mail, $phone){
		$data = array(
			"Nom" => $nom,
			"Prenom" => $prenom,
			"Email" => $mail,
			"Phone" => $phone
		);

		return $this->db->insert($this->table, $data);
	}

	function getDetails($id){
		return $this->db->query('SELECT * FROM circuit WHERE ID='.$id);
	}

	function getItineraire($id){
		return $this->db->query('SELECT o.Duration, o.Description, v.Ville, v.ImageUrl, v.Description FROM circuit c, circuitorder o, ville v WHERE o.IDCircuit=c.ID AND o.IDVille=v.ID AND c.ID='.$id.' ORDER BY o.CircuitOrder');	
	}

	function questionStatsByAdvertiser($idAdvertiser, $dateDebut, $dateFin)
	{
		return $this->db->query("SELECT q.question, q.idQuestion, u.dateAnswer, q.idAdvertiser, COUNT(q.question) AS compte FROM questions q, userreplies u WHERE u.idQuestion=q.idQuestion AND q.idAdvertiser=".$idAdvertiser." AND u.dateAnswer BETWEEN '".$dateDebut."' AND '".$dateFin."' GROUP BY q.idQuestion");
	}

	function questionStatsDefaultByAdvertiser($idAdvertiser)
	{
		return $this->db->query("SELECT q.question, q.idQuestion, u.dateAnswer, q.idAdvertiser, COUNT(q.question) AS compte FROM questions q, userreplies u WHERE u.idQuestion=q.idQuestion AND q.idAdvertiser=".$idAdvertiser." AND u.dateAnswer GROUP BY q.idQuestion");
	}

	function questionStatsByIDByAdvertiser($idQuestion, $dateDebut, $dateFin)
	{
		return $this->db->query("SELECT q.question, q.idQuestion, u.dateAnswer, q.idAdvertiser, COUNT(q.question) AS compte FROM questions q, userreplies u WHERE u.idQuestion=q.idQuestion AND q.idAdvertiser=".$idAdvertiser." AND q.idQuestion=".$idQuestion." AND u.dateAnswer BETWEEN '".$dateDebut."' AND '".$dateFin."'");
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

	
