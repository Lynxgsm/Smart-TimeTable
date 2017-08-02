<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_voyage extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->table = "voyage";
	}

	function get_all()
	{
		return $this->db->get($this->table);
	}

	function connect($username, $password)
	{
		return $this->db->query('SELECT login.username, login.password, client.ID, client.name FROM login, client WHERE login.username="'.$username.'" AND login.password="'.$password.'" AND login.ID_client=client.ID');
	}

	function post($client, $pub)
	{
		$data = array(
			"ID_client" => $client,
			"ID_pub" => $pub
		);

		return $this->db->insert($this->table, $data);
	}

	function getLastId()
	{
		return $this->db->query('SELECT * FROM pub ORDER BY ID DESC');
	}

	function put($id, $title)
	{
		$data = array(
			"title" => $title
		);

		$this->db->where("id", $id)
				 ->update($this->table, $data);
	}

	function delete($id)
	{
		$this->db->where_in("id", $id)
				 ->delete($this->table);
	}

}
