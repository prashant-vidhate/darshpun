<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomeModel extends CI_Model 
{   
	function __CONSTRUCT() {

	}

	public function login($uname, $password) {
		$uname = $this->db->escape($uname);
		$query = $this->db->query("SELECT user.id, login.* FROM user INNER JOIN login ON login.username = user.username where login.username = $uname and login.password = '$password'");
		if($query->num_rows() > 0) {
			$data = $query->row();
			return $data;
		} else {
			$this->session->set_flashdata('error', 'Invalid Username or Password');
			return false;
		}
	}
}
?>
