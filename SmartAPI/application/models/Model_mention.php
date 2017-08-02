<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_mention extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->table = "mention";
	}

	public function get_all()
	{
		return $this->db->get($this->table);
	}

	function get_mention()
	{
		return $this->db->query("SELECT q.idQuestion, q.question, q.idAnswer, q.idAdvertiser, a.firstAnswer, a.secondAnswer, a.rightAnswer FROM questions q, answers a WHERE q.idAnswer=a.idAnswer");
	}

	function getAnnee($mention){
		return $this->db->query("SELECT Annee FROM filiere WHERE IDMention='".$mention."' GROUP BY Annee");
	}

	function getFiliereByAnnee($annee, $mention){
		return $this->db->query('SELECT * FROM filiere WHERE Annee='.$annee.' AND IDMention="'.$mention.'"');
	}

	// GET QUESTION BY ID

	function get_question_by_ID($id){
		return $this->db->query("SELECT q.idQuestion, q.question, q.idAnswer, q.idAdvertiser, a.firstAnswer, a.secondAnswer, a.rightAnswer FROM questions q, answers a WHERE q.idAnswer=a.idAnswer AND q.idQuestion=".$id);
	}

	/* MODEL GET ANSWER BY ID

	function get_answer_by_ID($id)
	{
		return $this->db->query("SELECT a.idAnswer, a.firstAnswer, a.secondAnswer, a.rightAnswer, q.question, q.idQuestion FROM questions q, answers a WHERE a.idAnswer=q.idAnswer AND a.idAnswer=".$id);
	} */

	// MODEL UPDATE QUESTION
	function update_question($id, $question){
		$data = array(
			"question" => $question
			);

		$this->db->where("idQuestion", $id)
		->update('questions', $data);
	}

	// MODEL UPDATE ANSWER
	function update_answer($id, $first, $second, $right){
		$data = array(
			"firstAnswer" => $first,
			"secondAnswer" => $second,
			"rightAnswer" => $right
			);

		$this->db->where("idAnswer", $id)
		->update('answers', $data);
	}

	// MODEL INSERT QUESTION

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




	
/*
	function get_answer_by_ID($id){
		return $this->db->query("SELECT q.idQuestion, q.question, q.idAnswer, q.idAdvertiser, a.firstAnswer, a.secondAnswer, a.rightAnswer FROM questions q, answers a WHERE q.idAnswer=a.idAnswer AND a.idAnswer=".$id);
	}
*/
	function count_answer(){
		return $this->db->query('SELECT COUNT(*) FROM answers');
	}
}

	
