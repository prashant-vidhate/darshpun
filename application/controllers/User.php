<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->helper(array('url', 'form', 'string'));
        //$this->load->library(array('session', 'form_validation', 'email'));
        $this->load->model('userModel');

        //$joining_amount = 10000;
    }

    public function HomePage()
    {
        $this->load->view('Home/Homepage');
    }

    public function registerUser()
    {

        $joining_amount = 10000;

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
            $sponserId,$placementId,$placementPosition,$title,$firstName,$middleName,$lastName,$dob,$gender,$contact,
            $email,$pan,$location,$landmark,$city,$district,$state,$pincode,$country,$password);

        if ($newUsername != null) {
            $directReferalAmount = 1000;
            // Update user wallet for direct refferal income of direct user
            $directUserId = $this->userModel->getUserDetailsByUser($newUsername)->sponser_id;
            $userWallet = $this->userModel->getUserWalletByUserId($directUserId);

            if($userWallet->direct_referral_income < 1500) {
                $userWallet->direct_referral_income += $directReferalAmount;
                $this->userModel->updateUserWallet($userWallet);
            }            

            $userWallet = null;

            // Update user wallet of all users for profit sharing income / daily profit income
            $total_profit = $joining_amount * 0.05;
            $user_list = $this->userModel->getAllUserByActiveAndDeleted('ACTIVE', 'false');
            $countOfUsers = sizeof($user_list);
            $profit = $total_profit / $countOfUsers;
            foreach ($user_list as $user) {
                $userWallet = $this->userModel->getUserWalletByUserId($user->id);
                // users wallet's profit sharing value should not be zero
                if($userWallet->profit_sharing_value != 0) {
                    $profit_value = $userWallet->profit_sharing_value - $profit;
                    if($profit_value >= 0) {
                        $userWallet->profit_sharing_value = $profit_value;
                        $userWallet->daily_profit = $userWallet->daily_profit + $profit;
                    } else {
                        $userWallet->daily_profit = $userWallet->daily_profit + $userWallet->profit_sharing_value;
                        $userWallet->profit_sharing_value = 0;
                    }
                    $this->userModel->updateUserWallet($userWallet);
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Somthing went wrong. User is not registered. Please try again or contact administrator.');
            redirect('Home/JoinNow');
        }
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

    public function Dashboard()
    {
        $username = $this->session->userdata("user_username");
        $user_id = $this->session->userdata("user_id");
        $userDetails = $this->userModel->getUserDetailsByUser($username);
        if ($userDetails) {
            $userDetails->name = $userDetails->firstname . ' ' . $userDetails->middlename . ' ' . $userDetails->lastname;
        }
        $data['userDetails'] = $userDetails;
        $userWallet = $this->userModel->getUserWalletByUserId($user_id);
        if($userWallet == null) {
            $this->userModel->insertUserWalletDefault($user_id);
            $userWallet = $this->userModel->getUserWalletByUserId($user_id);
        } 
        $data['userWallet'] = $userWallet;
        $this->load->view('User/UserDashboard', $data);
    }

    public function Calender()
    {
        $this->load->view('User/Calender');
    }

    public function Logout()
    {
        $this->session->unset_userdata("user_id");
        $this->session->unset_userdata("user_username");
        $this->session->unset_userdata("user_role");
        redirect('Home/HomePage');
    }

    public function getUserTreeByPlacementId()
    {
        $user_id = $this->session->userdata("user_id");
        $userList = $this->userModel->getUserByPlacementId($user_id);
        $user = $this->userModel->getUserDetailsById($user_id);
        if ($user != null) {
            $user->placement_position = 'Root';
            array_push($userList, $user);
        }
        echo json_encode($userList);
    }

    public function BinaryTree()
    {
        $this->load->view('User/BinaryTree');
    }

}
