<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->helper(array('url', 'form', 'string'));
        //$this->load->library(array('session', 'form_validation', 'email'));
        $this->load->model('userModel');
    }

    public function HomePage()
    {
        $this->load->view('Home/Homepage');
    }

    public function registerUser()
    {
        $sponserId = $_POST['sponsorId'];
        $placementId = $_POST['placementId'];
        $placementPosition = $_POST['placementPosition'];
        $title = $_POST['title'];
        $firstName = $_POST['FirstName'];
        $middleName = $_POST['MiddleName'];
        $lastName = $_POST['LastName'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $pan = $_POST['pan'];
        $location = $_POST['location'];
        $landmark = $_POST['landmark'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $country = $_POST['country'];
        $password = $_POST['password'];

        $newUsername = $this->userModel->registerUser(
            $sponserId,
            $placementId,
            $placementPosition,
            $title,
            $firstName,
            $middleName,
            $lastName,
            $dob,
            $gender,
            $contact,
            $email,
            $pan,
            $location,
            $landmark,
            $city,
            $district,
            $state,
            $pincode,
            $country,
            $password
        );

        redirect('User/RegisterSummary/' . $newUsername);
    }

    public function RegisterSummary()
    {
        $newUsername = $this->uri->segment(3);
        $user = $this->userModel->getUserDetailsByUser($newUsername);
        if ($user != null) {
            $data['wrongUserId'] = false;
            $data['username'] = $newUsername;
        } else {
            $data['wrongUserId'] = true;
        }
        $this->load->view('Home/registration_summary', $data);

    }

    public function Dashboard() {
        $username = $this->session->userdata("user_username");
        $userDetails = $this->userModel->getUserDetailsByUser($username);
        if($userDetails) {
            $userDetails->name = $userDetails->firstname.' '.$userDetails->middlename.' '.$userDetails->lastname;
        }
        $data['userDetails'] = $userDetails;
        $data['userTreeArray'] = $this->userModel->getUserByPlacementId(8);
        $this->load->view('User/UserDashboard', $data);
    }

    public function Calender() {
        $this->load->view('User/Calender');
    }

    public function Logout() {
        $this->session->unset_userdata("user_id");
        $this->session->unset_userdata("user_username");
        $this->session->unset_userdata("user_role");
        redirect('Home/HomePage');
    }

    public function getUserTreeByPlacementId() {
        $user_id = $this->session->userdata("user_id");
        $userList = $this->userModel->getUserByPlacementId($user_id);
        $user = $this->userModel->getUserDetailsById($user_id);
        if($user != null) {
            array_push($userList, $user);
        }
        echo json_encode($userList);
    }

    public function BinaryTree() {
        $this->load->view('User/BinaryTree');
    }

}