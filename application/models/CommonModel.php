<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommonModel extends CI_Model 
{   
	function __CONSTRUCT() {

	}

	public function getUserDetailsFromUsername($username) {
		$query = $this->db->query("select * from user where username = '$username'");
		if($query->num_rows() > 0) {
			$data = $query->row();
			return $data;
		} else {
			$this->session->set_flashdata('error', 'Data Not found.');
			return false;
		}
	}
}
?>
