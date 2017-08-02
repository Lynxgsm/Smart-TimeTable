<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->table = "login";
	}

	public function login($username, $mdp)
	{
		return $this->db->query('SELECT l.Username, l.Password, u.Type FROM usertype u, login l WHERE l.IDUserType=u.ID AND username="'.$username.'" AND password="'.$mdp.'"');
	}
}