<?php defined('BASEPATH') OR exit('No direct script access allowed');

class api extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Model_enseignant');
		$this->load->model('Model_salle');
		$this->load->model('Model_filiere');
		$this->load->model('Model_cours');
		$this->load->model('Model_login');
		$this->load->model('Model_mention');
		$this->load->model('Model_timetable');
		$this->load->model('Model_matiere');
		header("Access-Control-Allow-Origin: *"); // CORS Origin enabled
	}

	public function getEtudiantsCount(){

	}

	public function getAllEnseignant()
	{
		$data = $this->Model_enseignant->get_all();
		
		if ($data->num_rows() > 0) 
		{
			foreach ($data->result() as $row)
			{
				$result[] = array("ID" => intval($row->ID), "nom" => $row->Nom, "prenom"=>$row->Prenom, "mail"=>$row->Email, "phone"=>$row->Phone);
			}
			echo json_encode($result);
		} 
		else 
		{
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no students in the database");
		}

	}

	public function insertEnseignant(){
		$nom=$this->input->post('nom');
		$prenom=$this->input->post('prenom');
		$mail=$this->input->post('mail');
		$phone=$this->input->post('phone');

		if(empty($nom)){
			$nom=$this->input->get('nom');
			$prenom=$this->input->get('prenom');
			$mail=$this->input->get('mail');
			$phone=$this->input->get('phone');			
		}

		echo $nom."; ".$prenom."";

		if (isset($nom) && isset($phone)){
			$data=$this->Model_enseignant->insert($nom, $prenom, $mail, $phone);
			echo json_encode(array('result'=>true));
		}

		else{
			echo json_encode(array('result'=>false));
		}
	}

	//SALLE

		public function getAllSalles()
	{
		$data = $this->Model_salle->get_all();
		
		if ($data->num_rows() > 0) 
		{
			foreach ($data->result() as $row)
			{
				$result[] = array("ID" => $row->ID, "nom" => $row->Nom, "emplacement"=>$row->Emplacement, "capacite"=>$row->Capacite);
			}
			echo json_encode($result);
		} 

		else 
		{
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no students in the database");
		}

	}

	public function insertSalle(){
		$nom=$this->input->post('nom');
		$prenom=$this->input->post('prenom');
		$mail=$this->input->post('mail');
		$phone=$this->input->post('phone');

		if(empty($nom)){
			$nom=$this->input->get('nom');
			$prenom=$this->input->get('prenom');
			$mail=$this->input->get('mail');
			$phone=$this->input->get('phone');			
		}

		echo $nom."; ".$prenom."";

		if (isset($nom) && isset($phone)){
			$data=$this->Model_enseignant->insert($nom, $prenom, $mail, $phone);
			echo json_encode(array('result'=>true));
		}

		else{
			echo json_encode(array('result'=>false));
		}
	} 

	public function getFilieresByAnnee(){
		$annee=$this->input->get('annee');
		$data=$this->Model_filiere->getFilieresByAnnee($annee);
				
		if ($data->num_rows() > 0) 
		{
			foreach ($data->result() as $row)
			{
				$result[] = array("ID" => $row->ID, "libelle" => $row->Libelle, "effectif"=>$row->Effectif,"annee"=>$row->Annee);
			}
			echo json_encode($result);
		} 
		else 
		{
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no students in the database");
		}	
	}
 
	//FILIERE

		public function getFiliereByAnnee()
	{
		$annee=$this->input->get('annee');
		$mention=$this->input->get('mention');
		$data = $this->Model_mention->getFiliereByAnnee($annee, $mention);
		
		if ($data->num_rows() > 0) 
		{
			foreach ($data->result() as $row)
			{
				$result[] = array("ID" => $row->ID, "libelle" => $row->Libelle, "effectif"=>$row->Effectif,"annee"=>$row->Annee, "diplome"=>$row->IDDiplome, "mention"=>$row->IDMention);
			}
			echo json_encode($result);
		} 
		else 
		{
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no students in the database");
		}
	}

	public function insertFiliere(){
		$nom=$this->input->post('nom');
		$prenom=$this->input->post('prenom');
		$mail=$this->input->post('mail');
		$phone=$this->input->post('phone');

		if(empty($nom)){
			$nom=$this->input->get('nom');
			$prenom=$this->input->get('prenom');
			$mail=$this->input->get('mail');
			$phone=$this->input->get('phone');			
		}

		echo $nom."; ".$prenom."";

		if (isset($nom) && isset($phone)){
			$data=$this->Model_enseignant->insert($nom, $prenom, $mail, $phone);
			echo json_encode(array('result'=>true));
		}

		else{
			echo json_encode(array('result'=>false));
		}
	}

	/*=============================================================
								LOGIN
	===============================================================*/

	public function login()
	{
		$username=$this->input->get('username');
		$mdp=$this->input->get('password');
		$data=$this->Model_login->login($username, $mdp);

		if ($data->num_rows()>0) {
			foreach ($data->result() as $row)
			{
				$result[] = array("username" => intval($row->Username), "usertype" => $row->Type, 'login' => true);
			}
			echo json_encode($result);
		}

		else
		{
			$result = array('login' => false);
			echo json_encode($result);
		}
	}

	/*=============================================================
								MENTION
	===============================================================*/

	public function getMentions(){
		$data=$this->Model_mention->get_all();
				
		if ($data->num_rows() > 0) 
		{
			foreach ($data->result() as $row)
			{
				$result[] = array("ID" => $row->ID, "libelle" => $row->Libelle);
			}
			echo json_encode($result);
		} 
		else 
		{
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no students in the database");
		}
	}

	/*=============================================================
								NIVEAU
	===============================================================*/

	public function getNiveauByMention(){
		$id=$this->input->get('id');
		$data=$this->Model_mention->get_niveau_by_mention($id);
				
		if ($data->num_rows() > 0) 
		{
			foreach ($data->result() as $row)
			{
				$result[] = array("ID" => $row->ID, "libelle" => $row->Libelle);
			}
			echo json_encode($result);
		} 
		else 
		{
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no students in the database");
		}
	}

	public function getAnnee(){
		$id=$this->input->get('mention');
		$data=$this->Model_mention->getAnnee($id);
				
		if ($data->num_rows() > 0) 
		{
			foreach ($data->result() as $row)
			{
				$result[] = array("annee" => $row->Annee);
			}
			echo json_encode($result);
		} 
		
		else 
		{
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no students in the database");
		}
	}

	/*=======================================================================
									MATIERES
	========================================================================*/
  	
	public function getCours()
	{
		$filiere=$this->input->get('filiere');
		$split=preg_split("#,#", $filiere);
		print(count($split));

		/*$data = $this->Model_filiere->get_cours_by_filiere($filiere);
		
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$result[] = array("IDFiliere" => $row->ID, "matiere" => $row->Libelle, "IDMatiere"=>$row->matiere);
			}
			echo json_encode($result);
		} else {
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no cours in the database");
		}*/
	}

	public function getTimeTable(){
		$date=$this->input->get('date');
		$data = $this->Model_cours->getTimetable($date);

		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$result[] = array("matiere" => $row->IDMatiere, "filiere" => $row->IDFiliere, "salle"=>$row->IDSalle, "date"=>$row->DateCours, "heureDebut"=>$row->HeureDebut, "heureFin"=>$row->HeureFin);
			}
			
			echo json_encode($result);
		} else {
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no cours in the database");
		}	
	}

	public function insertTimeTable(){
		$matiere=$this->input->get('matiere');
		$filiere=$this->input->get('filiere');
		$salle=$this->input->get('salle');
		$heureDebut=$this->input->get('heureDebut');
		$heureFin=$this->input->get('heureFin');
		$dateCours=$this->input->get('dateCours');
		$description=$this->input->get('description');
		$timezone="am";

		if ($heureDebut>"12:00"){
			$timezone="pm";
		}

		$data=$this->Model_timetable->insertTimeTable($matiere, $filiere, $salle, $dateCours, $heureDebut, $heureFin, $timezone, $description);

		if ($data){
			echo json_encode(array("result"=>true));
		}

		else{
			echo json_encode(array("result"=>false));	
		}
	}

	public function checkIfTimeIsAvailable(){
		$date=$this->input->get('date');
		$heureDebut=$this->input->get('heureDebut');
		$heureFin=$this->input->get('heureFin');
		$salle=$this->input->get('salle');
		$data = $this->Model_cours->checkIfTimeIsAvailable($date, $heureDebut, $salle);
		
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$result[] = array("matiere" => $row->IDMatiere, "filiere" => $row->IDFiliere, "salle"=>$row->IDSalle, "date"=>$row->DateCours, "heureDebut"=>$row->HeureDebut, "heureFin"=>$row->HeureFin);
			}
			
			echo json_encode($result);
		} 

		$data = $this->Model_cours->checkIfTimeIsAvailable($date, $heureFin, $salle);
		
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$result[] = array("matiere" => $row->IDMatiere, "filiere" => $row->IDFiliere, "salle"=>$row->IDSalle, "date"=>$row->DateCours, "heureDebut"=>$row->HeureDebut, "heureFin"=>$row->HeureFin);
			}
			
			echo json_encode($result);
		}	
	}

	public function getAllMatieres(){
		$data = $this->Model_matiere->get_all();
		
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$result[] = array("ID" => $row->ID, "libelle" => $row->Libelle, "nbHeures"=>$row->NbHeures);
			}
			echo json_encode($result);
		} else {
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no cours in the database");
		}	
	}

	// RECUP ID QUESTION

	public function getQuestionsByID()
	{
		$id=$this->input->get('id');
		$data = $this->Model_questions->get_question_by_ID($id);
		
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$result[] = array("idQuestion" => intval($row->idQuestion), "question" => $row->question, "firstAnswer"=>$row->firstAnswer, "secondAnswer"=>$row->secondAnswer, "rightAnswer"=>$row->rightAnswer, "description"=>"", "idAnswer"=>intval($row->idAnswer));
			}
			echo json_encode($result);
		} else {
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no question in the database");
		}
	}

	// RECUP ID ANSWER

	public function getAnswerByID()
	{
		$id = $this->input->get('id');

		$data = $this->Model_questions->get_answer_by_ID($id);

		if ($data->num_rows()>0) {
			foreach ($data->result() as $row) {
				$result[] = array('idAnswer' =>$row->idAnswer, 'question'=>$row->question, 'firstAnswer'=>$row->firstAnswer, 'secondAnswer'=>$row->secondAnswer, 'rightAnswer'=>$row->rightAnswer, 'idQuestion'=>$row->idQuestion);

				echo json_encode($result);
			}
		}
		else{
			echo json_encode(array('result'=>false));
		}


	}


	// UPDATE QUESTION
	public function updateQuestion(){

		$id=$this->input->post('id');
		$question=$this->input->post('question');

		if (isset($id) && isset($question)){
			$data=$this->Model_questions->update_question($id, $question);
			echo json_encode(array('result'=>true));
		}

		else{
			echo json_encode(array('result'=>false));
		}
	}


	// UPDATE ANSWER

	public function updateAnswer(){

		$id=$this->input->post('id');
		$firstAnswer=$this->input->post('firstAnswer');
		$secondAnswer=$this->input->post('secondAnswer');
		$rightAnswer=$this->input->post('rightAnswer');

		//echo $id.' '.$firstAnswer.' '.$secondAnswer." ".$rightAnswer;

		if (isset($id) && isset($firstAnswer) && isset($secondAnswer) && isset($rightAnswer)){
			$data=$this->Model_questions->update_answer($id, $firstAnswer, $secondAnswer, $rightAnswer);
			echo json_encode(array('result'=>true));
		}

		else{
			echo json_encode(array('result'=>false));
		}
	}

	public function insertAnswers(){
		$first=$this->input->post('first');
		$second=$this->input->post('second');
		$right=$this->input->post('right');

		if (isset($first) && isset($second) && isset($right)){
			$data=$this->Model_questions->insertAnswers($first, $second, $right);
			$insertId = $this->db->insert_id();
			echo json_encode(array('result'=>$data, 'id'=>$insertId));
		}

		else{
			echo json_encode(array('result'=>false));
		}
	}

	/*==============================================================================
									USER INFORMATIONS
	================================================================================*/


	// API INSERT USER
	public function signup(){
		$first=$this->input->post('first');
		$last=$this->input->post('last');
		$phone=$this->input->post('phone');
		$mdp=$this->input->post('mdp');

		if (isset($first) && isset($phone) && isset($mdp)){
			$data=$this->Model_user->insertUser($first, $last, $phone, $mdp);
			$insertId = $this->db->insert_id();
			echo json_encode(array('result'=>$data, 'id'=>$insertId));
		}

		else{
			echo json_encode(array('result'=>false));
		}
	}


   // API GET ALL USERS
	public function getAllUsers(){
		$data=$this->Model_user->get_allUsers();

		if ($data->num_rows()>0) 
		{
			foreach ($data->result() as $row)
			{
				$result[] = array("idUser" => intval($row->idUser), "firstName" => $row->firstName, "lastName"=>$row->lastName, "phoneNumber"=>$row->phoneNumber, "password"=>$row->password);
			}
			echo json_encode($result);
		} 

		else 
		{
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no users in the database");
		}
	}


		// USER CONNECT
	public function userConnect(){
		$phone=$this->input->get('phone');
		$mdp=$this->input->get('mdp');

		$mdp=md5($mdp);

		$data=$this->Model_user->userConnect($phone, $mdp);
		if ($data->num_rows()>0) 
		{

			$result = array('userConnect' => "OK");
			echo json_encode($result);

			/*
			header("HTTP/1.0 200 OK");
			echo json_encode(array("login"=>true));*/
		} 

		else 
		{

			$result = array('userConnect' => "NOT OK");
			echo json_encode($result);
			/*
			header("HTTP/1.0 200 NOT OK");
			echo json_encode(array("login"=>false));*/
		}
	}

	/*==============================================================================
									USER SCORE
	================================================================================*/





	/*==============================================================================
									STATS
	================================================================================*/

	public function getQuestionStatsByAdvertiser(){
		$id=$this->input->get('idAdvertiser');
		$datedebut=$this->input->get('dateDebut');
		$datedebut=$this->input->get('dateFin');
		$data=$this->Model_userreplies->questionStatsByAdvertiser($dateDebut, $dateFin);

		if ($data->num_rows()>0) 
		{
			foreach ($data->result() as $row)
			{
				$result[] = array("idQuestion" => intval($row->idQuestion), "question" => $row->question, "dateAnswer"=>$row->dateAnswer, "count"=>$row->compte);
			}
			echo json_encode($result);
		} 

		else 
		{
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no stat in the database");
		}
	}

	public function getQuestionStatsDefaultByAdvertiser(){
		$id=$this->input->get('idAdvertiser');
		$data=$this->Model_userreplies->questionStatsDefaultByAdvertiser($id);

		if ($data->num_rows()>0) 
		{
			foreach ($data->result() as $row)
			{
				$result[] = array("idQuestion" => intval($row->idQuestion), "question" => $row->question, "dateAnswer"=>$row->dateAnswer, "count"=>$row->compte);
			}
			echo json_encode($result);
		} 

		else 
		{
			header("HTTP/1.0 204 No Content");
			echo json_encode("204: no stat in the database");
		}
	}


}
