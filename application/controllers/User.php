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
            // 1. Update user wallet for direct refferal income of direct user
            // 2. Update user wallet of all users for profit sharing income / daily profit income
            // 3. Update user wallet of all upper level placement nodes for binary income

            $newCreatedUser = $this->userModel->getUserDetailsByUser($newUsername);
            // 1. Update user wallet for direct refferal income of direct user
            $this->updateDirectReferral($newCreatedUser);

            //2.  Update user wallet of all users for profit sharing income / daily profit income
            $this->updateWalletForProfitSharingIncome($joining_amount, $newCreatedUser);

            // 3. Update user wallet of all upper level placement nodes for binary income
            $this->updateBinaryIncomeOfParentNodes($newCreatedUser);

            // 4. Update direct referral count for sponser ID
            $this->updateDirectReferralCountForSponser($newCreatedUser);
        } else {
            $this->session->set_flashdata('error', 'Somthing went wrong. User is not registered. Please try again or contact administrator.');
            redirect('Home/JoinNow');
        }
        redirect('User/RegisterSummary/' . $newUsername);
    }

    public function updateDirectReferralCountForSponser($newCreatedUser) {
        $sponserUserMapping = $this->userModel->getDirectReferralUserMappingByUserId($newCreatedUser->sponser_id);
        if($sponserUserMapping != null) {
            $sponserUserMapping->direct_referrals = $sponserUserMapping->direct_referrals + 1;
            $this->userModel->updateDirectReferralMapping($sponserUserMapping->user_id, $sponserUserMapping->direct_referrals);
        }
    }

    public function updateDirectReferral($newCreatedUser) {
        $directReferalAmount = 1000;
        $userWallet = $this->userModel->getUserWalletByUserId($newCreatedUser->sponser_id);

        if($userWallet->direct_referral_income < 1500) {
            $userWallet->direct_referral_income += $directReferalAmount;
            $update = $this->userModel->updateUserWallet($userWallet);
            if($update) {
                $user_id = $userWallet->user_id;
                $new_user_id = $newCreatedUser->id;
                $transaction_date = date('Y-m-d h:i:sa');
                $transaction_amount = $directReferalAmount;
                $transaction_remark = $newCreatedUser->username.'/'.$newCreatedUser->firstname.' '.$newCreatedUser->lastname.'/ Invite Partner Income';
                $created_date = date('Y-m-d h:i:sa');

                $this->userModel->insertDirectReferralHistory(
                    $user_id , $new_user_id , $transaction_date , $transaction_amount , $transaction_remark , $created_date
                );
            }
        }
    }

    public function updateBinaryIncomeOfParentNodes($newCreatedUser) {
        $placementId = $newCreatedUser->placement_id;
        while($placementId != 0) {
            $userWallet = null;
            $rightChildCount = sizeof($this->userModel->getAllChildsByPlacementIdAndSide($placementId, 'right'));
            $leftChildCount = sizeof($this->userModel->getAllChildsByPlacementIdAndSide($placementId, 'left'));
            if($rightChildCount >= $leftChildCount) {
                $binaryIncome = $leftChildCount * 500;
            } else {
                $binaryIncome = $rightChildCount * 500;
            }
            $userWallet = $this->userModel->getUserWalletByUserId($placementId);
            $userWallet->binary_income = $binaryIncome;
            $update = $this->userModel->updateUserWallet($userWallet);

            if($update) {
                $user_id = $userWallet->user_id;
                $new_user_id = $newCreatedUser->id;
                $pair_match = $binaryIncome / 500;
                $transaction_date = date('Y-m-d h:i:sa');
                $transaction_amount = $binaryIncome;
                $transaction_remark = 'Growth Partner Income';
                $created_date = date('Y-m-d h:i:sa');

                $this->userModel->insertBinaryIncomeHistory(
                    $user_id, $new_user_id, $pair_match, $transaction_date, $transaction_amount, $transaction_remark, $created_date
                );
            }

            $placementId = $this->userModel->getUser($placementId)->placement_id;
        }
    }

    public function updateWalletForProfitSharingIncome($joining_amount, $newCreatedUser) {
        $userWallet = null;        
        $total_profit = $joining_amount * 0.05;
        $user_list = $this->userModel->getUserForProfitSharing('ACTIVE', 'false', $newCreatedUser->id);
        $final_user_list = array();

        foreach ($user_list as $user) {
            if($user->direct_referral != null) {
                $childUserSize = $user->direct_referral;
            } else {
                // insert entry for sponser
                $childUserSize = 0;
            }

            $nowFormat = date('Y-m-d H:i:s');
        
            $hourdiff = round((strtotime($nowFormat) - strtotime($user->created_date))/3600, 1);
            if($childUserSize < 2 && $hourdiff >= 12) {
                array_push($final_user_list, $user);
            }
        }

        $countOfUsers = sizeof($final_user_list);

        if($countOfUsers != 0) {
            $profit = $total_profit / $countOfUsers;
            foreach ($final_user_list as $user) {
                $userWallet = $this->userModel->getUserWalletByUserId($user->id);
                // users wallet's profit sharing value should not be zero
                if($userWallet->profit_sharing_value != 0) {
                    $profit_value = $userWallet->profit_sharing_value - $profit;
                    if($profit_value >= 0) {
                        $userWallet->profit_sharing_value = $profit_value;
                        $userWallet->daily_profit = $userWallet->daily_profit + $profit;
                        $transaction_amount = $profit;    
                    } else {
                        $userWallet->daily_profit = $userWallet->daily_profit + $userWallet->profit_sharing_value;
                        $transaction_amount = $userWallet->profit_sharing_value;    
                        $userWallet->profit_sharing_value = 0;
                    }
                    $isUpdated = $this->userModel->updateUserWallet($userWallet);

                    if($isUpdated) {
                        $user_id = $userWallet->user_id;
                        $new_user_id = $newCreatedUser->id;
                        $transaction_date = date('Y-m-d h:i:sa');
                        $transaction_remark = $newCreatedUser->username.'/'.$newCreatedUser->firstname.' '.$newCreatedUser->lastname.'/ Daily Profit';
                        $created_date = date('Y-m-d h:i:sa');

                        $this->userModel->insertProfitSharingHistory(
                            $user_id, $new_user_id, $transaction_date, $transaction_amount, $transaction_remark, $created_date
                        );
                    }
                }
            }
        }
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

    public function ViewProfile() {
        $viewMode = true;
        $this->showProfile($viewMode);
    }

    public function ShoppingFund() {
        $user_id = $this->session->userdata("user_id");
        $data['userWallet'] = $this->userModel->getUserWalletByUserId($user_id);
        $this->load->view('User/ShoppingFund', $data);
    }
    
    public function BinaryIncome() {
        $user_id = $this->session->userdata("user_id");
        $data['userWallet'] = $this->userModel->getUserWalletByUserId($user_id);
        $data['binaryIncomeHistory'] = $this->userModel->getBinaryIncomeHistoryByUserId($user_id);
        $this->load->view('User/BinaryIncome', $data);
    }

    public function ProfileSharingValue() {
        $user_id = $this->session->userdata("user_id");
        $userWallet = $this->userModel->getUserWalletByUserId($user_id);
        $userWallet->DefaultProfitSharingValue = 100000.00;
        $data['userWallet'] = $userWallet;
        $data['profitSharingHistory'] = $this->userModel->getProfitSharingHistoryByUserId($user_id);
        $this->load->view('User/ProfileSharingValue', $data);
    }

    public function DirectReferralIncome() {
        $user_id = $this->session->userdata("user_id");
        $data['userWallet'] = $this->userModel->getUserWalletByUserId($user_id);
        $data['directReferralHistory'] = $this->userModel->getDirectReferralHistoryByUserId($user_id);
        $this->load->view('User/DirectReferralIncome', $data);
    }

    public function showProfile($viewMode) {
        $userId = $this->session->userdata("user_id");
        if(isset($_GET['username'])) {
            $username = $_GET['username'];
            $user = $this->userModel->getUserDetailsByUser($username);
            if($user != null) {
                $userId = $user->id;
            } else {
                //$this->session->set_flashdata('error', $username. 'username is not exist. Please pass correct username');
                //$this->DirectReferralList();
            }
        } else {
            //$this->session->set_flashdata('error', 'Wrong URL.');
            //$this->DirectReferralList();
        }
        
        $details = $this->userModel->getPersonalDetails($userId);
        $details->name = $details->firstname.' '.$details->middlename.' '.$details->lastname;

        $sponser = $this->userModel->getUser($details->sponser_id);
        if($sponser != null) {
            $details->sponserUsername = $sponser->username;
            $details->sponserName = $sponser->firstname.' '.$sponser->middlename.' '.$sponser->lastname;;
        }

        $placement = $this->userModel->getUser($details->placement_id);
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
        $user = $this->userModel->getUser($user_id);
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

    public function DirectReferralList() {
        $user_id = $this->session->userdata("user_id");
        $DirectReferralList = $this->userModel->getDirectReferralList($user_id);
        foreach ($DirectReferralList as $DirectReferral) {
            $DirectReferral->name = $DirectReferral->firstname.' '.$DirectReferral->middlename.' '.$DirectReferral->lastname;
        }
        $data['DirectReferralList'] = $DirectReferralList;
        $this->load->view('User/DirectReferralList', $data);
    }

    public function LeftGroupList() {
        $user_id = $this->session->userdata("user_id");
        $userIdList = array();
        $userList = $this->userModel->getAllChildsByPlacementIdAndSide($user_id, 'left');
        foreach ($userList as $user) {
            array_push($userIdList, $user->id);
        }
        $userArrStr = implode(", ", $userIdList);
        $LeftGroupList = $this->userModel->getGroupListByUserList($userArrStr);
        foreach ($LeftGroupList as $leftGroupUser) {
            $leftGroupUser->name = $leftGroupUser->firstname.' '.$leftGroupUser->middlename.' '.$leftGroupUser->lastname;
        }
        $data['LeftGroupList'] = $LeftGroupList;
        $this->load->view('User/LeftGroupList', $data);
    }

    public function RightGroupList() {
        $user_id = $this->session->userdata("user_id");
        $userIdList = array();
        $userList = $this->userModel->getAllChildsByPlacementIdAndSide($user_id, 'right');
        foreach ($userList as $user) {
            array_push($userIdList, $user->id);
        }
        $userArrStr = implode(", ", $userIdList);
        $rightGroupList = $this->userModel->getGroupListByUserList($userArrStr);
        foreach ($rightGroupList as $rightGroupUser) {
            $rightGroupUser->name = $rightGroupUser->firstname.' '.$rightGroupUser->middlename.' '.$rightGroupUser->lastname;
        }
        $data['rightGroupList'] = $rightGroupList;
        $this->load->view('User/rightGroupList', $data);
    }

    public function LevelWiseList() {
        $user_id = $this->session->userdata("user_id");
        $duplicateLevelArr = array();
        $userList = $this->userModel->getUserByPlacementId($user_id);
        $user = $this->userModel->getUser($user_id);
        if ($user != null) {
            array_push($userList, $user);
        }
        foreach ($userList as $user) {
            $level = $this->userModel->getUserLevelByUserId($user_id, $user->id);
            if($level != null) {
                array_push($duplicateLevelArr, $level);
            }
        }
        $uniqueValueCount = array_count_values($duplicateLevelArr);
        
        ksort($uniqueValueCount);

        $data['levelCountList'] = $uniqueValueCount;
        $this->load->view('User/LevelCountList', $data);
    }

    public function ViewUsers() {
        $user_id = $this->session->userdata("user_id");
        $level = 1;
        $userIdList = array();
        $userListByLevel = array();

        if(isset($_GET['level'])) {
            $level = $_GET['level'];
        }
        
        $userList = $this->userModel->getUserByPlacementId($user_id);
        $user = $this->userModel->getUser($user_id);
        if ($user != null) {
            array_push($userList, $user);
        }

        foreach ($userList as $user) {
            $userLevel = $this->userModel->getUserLevelByUserId($user_id, $user->id);
            if($userLevel != null && $userLevel == $level) {
                array_push($userIdList, $user->id);
            }
        }

        $userArrStr = implode(", ", $userIdList);


        if($userArrStr !== '') {
            $userListByLevel = $this->userModel->getGroupListByUserList($userArrStr);
            foreach ($userListByLevel as $singleUser) {
                $singleUser->name = $singleUser->firstname.' '.$singleUser->middlename.' '.$singleUser->lastname;
            }
        }

        $data['userListByLevel'] = $userListByLevel;
        $data['PageHeading'] = 'Level '.$level.' Partner List';
        $this->load->view('User/UserList', $data);
    }
}
