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

    public function MyProfile() {
        $viewMode = true;
        $this->showProfile($viewMode);
    }

    public function UpdateProfile() {
        $viewMode = false;
        $this->showProfile($viewMode);
    }

    public function showProfile($viewMode) {
        $userId = $this->session->userdata("user_id");
        $details = $this->userModel->getPersonalDetails($userId);
        $details->name = $details->firstname.' '.$details->middlename.' '.$details->lastname;

        $sponser = $this->userModel->getUserDetailsById($details->sponser_id);
        if($sponser != null) {
            $details->sponserUsername = $sponser->username;
            $details->sponserName = $sponser->firstname.' '.$sponser->middlename.' '.$sponser->lastname;;
        }

        $placement = $this->userModel->getUserDetailsById($details->placement_id);
        if($placement != null) {
            $details->placementUsername = $placement->username;
            $details->placementName = $placement->firstname.' '.$placement->middlename.' '.$placement->lastname;;
        }
        
        $data['ProfileDetails'] = $details;
        $data['viewMode'] = $viewMode;
        $this->load->view('User/UpdateProfile', $data);
    }

    public function updatePassword() {
        $this->load->view('User/updatePassword');
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

    public function UpdateUser() {
        $userId = $this->session->userdata("user_id");

        $firstName = htmlentities($this->security->xss_clean($_POST['firstName']));
        $middleName = htmlentities($this->security->xss_clean($_POST['middleName']));
        $lastName = htmlentities($this->security->xss_clean($_POST['lastName']));
        $dob = htmlentities($this->security->xss_clean($_POST['dob']));
        $gender = htmlentities($this->security->xss_clean($_POST['gender']));
        $mobile = htmlentities($this->security->xss_clean($_POST['mobile']));
        $email = htmlentities($this->security->xss_clean($_POST['email']));
        $location = htmlentities($this->security->xss_clean($_POST['location']));
        $landmark = htmlentities($this->security->xss_clean($_POST['landmark']));
        $city = htmlentities($this->security->xss_clean($_POST['city']));
        $district = htmlentities($this->security->xss_clean($_POST['district']));
        $state = htmlentities($this->security->xss_clean($_POST['state']));
        $pincode = htmlentities($this->security->xss_clean($_POST['pincode']));
        $country = htmlentities($this->security->xss_clean($_POST['country']));

        $Pan = htmlentities($this->security->xss_clean($_POST['Pan']));
        $BankName = htmlentities($this->security->xss_clean($_POST['BankName']));
        $BankBranch = htmlentities($this->security->xss_clean($_POST['BankBranch']));
        $BankIFSCCode = htmlentities($this->security->xss_clean($_POST['BankIFSCCode']));
        $AccountNo = htmlentities($this->security->xss_clean($_POST['AccountNo']));
        $accountType = htmlentities($this->security->xss_clean($_POST['accountType']));

        $this->userModel->updateUser(
            $firstName, $middleName, $lastName, $dob, $gender, $mobile, $email, $location, $landmark, $city, $district, $state, $pincode, $country, $userId);

        $isUpdated = $this->userModel->updateBankDetails($Pan, $BankName, $BankBranch, $BankIFSCCode, $AccountNo, $userId, $accountType);

        if ($isUpdated) {
            $this->session->set_flashdata('success', 'Profile is updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Somthing went wrong. Profile is not updated. Please try again or contact administrator.');
        }
        redirect('User/UpdateProfile');
    }

    public function ChangePassword() {
        $username = $this->session->userdata("user_username");

        $NewPassword = sha1(htmlentities($this->security->xss_clean($_POST['NewPassword'])));
        $ConfirmPassword = sha1(htmlentities($this->security->xss_clean($_POST['ConfirmPassword'])));
        
        if($NewPassword === $ConfirmPassword) {
            $changed = $this->userModel->changePassword($NewPassword, $username);
            if($changed) {
                $this->session->set_flashdata('success', 'Password is changed successfully.');
            } else {
                $this->session->set_flashdata('error', 'Somthing went wrong. Password not changed. Please try again or contact administrator.');
            }
        } else {
            $this->session->set_flashdata('error', 'New password and confirm password is not matched.');
        }
        redirect('User/updatePassword');
    }
}
