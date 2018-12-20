<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('homeModel');
        $this->load->model('adminModel');
    }

	public function Dashboard() {
        $this->load->view('Admin/AdminDashboard');
    }

    public function Logout() {
        $this->session->unset_userdata("admin_id");
        $this->session->unset_userdata("admin_username");
        $this->session->unset_userdata("admin_role");
        redirect('Home/HomePage');
    }
}