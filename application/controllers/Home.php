<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        //$this->load->helper(array('url','form','string'));
        //$this->load->library(array("session","form_validation","email"));
        $this->load->model('homeModel');
        $this->load->model('userModel');
    }

	public function HomePage() {
        $this->load->view('Home/Homepage');
    }

    public function AboutUs() {
        $this->load->view('Home/about-us');
    }

    public function Products() {
        $this->load->view('Home/coming-soon');
    }

    public function Opportunity() {
        $this->load->view('Home/Opportunity');
    }

    public function Project() {
        $this->load->view('Home/coming-soon');
    }

    public function Legal() {
        $this->load->view('Home/Legal');
    }

    public function Faq() {
        $this->load->view('Home/Faq');
    }

    public function Support() {
        $this->load->view('Home/coming-soon');
    }

    public function Overview() {
        $this->load->view('Home/coming-soon');
    }

    public function JoinNow() {
        $this->load->view('Home/JoinNow');
    }

    public function getSponserById() {
        set_error_handler(
			create_function(
			'$severity, $message, $file, $line',
			'throw new ErrorException($message, $severity, $severity, $file, $line);'
			)
		);

		$userName = htmlentities($this->security->xss_clean($this->input->post('sponserId')));
        $sponser = $this->userModel->getUserDetailsByUser($userName);
        if($sponser != null) {
            echo $sponser->firstname.' '.$sponser->lastname;
        }
        echo null;
    }

    public function login() {
        $username = htmlentities($this->security->xss_clean($_POST['username']));
        $password = sha1($_POST['password']);
        $result = $this->homeModel->login($username, $password);

        if ($result->user_role === 'USER') {
            $this->session->set_userdata("user_username", $result->username);
            $this->session->set_userdata("user_id", $result->id);
            $this->session->set_userdata("user_role", $result->user_role);
            redirect('User/Dashboard');
        } else if ($result->user_role === 'ADMIN') {
            $this->session->set_userdata("admin_username", $result->username);
            $this->session->set_userdata("admin_id", $result->id);
            $this->session->set_userdata("admin_role", $result->user_role);
            redirect('Admin/Dashboard');
        }
        redirect('home/HomePage');	
    }
}
