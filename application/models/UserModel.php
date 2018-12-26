<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model 
{   
	function __CONSTRUCT() {
		//$joining_amount = 10000;
	}

	public function getUserDetailsByUser($username) {
		$result = $this->db->query("SELECT * FROM user WHERE username = '$username'");
		if($result->num_rows() > 0) {
			return $result->row();
		}
		return null;
	}

	public function getChildOfSponser($sponserId) {
		$result = $this->db->query("SELECT * FROM user WHERE sponser_id = '$sponserId'");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return [];
	}

	public function registerUser($sponserId, $placementId, $placementPosition, $title, $firstName, $middleName, $lastName, $dob, $gender, $contact, $email, $pan, 
		$location, $landmark, $city, $district, $state, $pincode, $country, $password) {
			
		$joining_amount = 10000;

		// GENERATE USERNAME	
		$digits = 6;
		$generatedUsername = rand(pow(10, $digits-1), pow(10, $digits)-1);
		$newUsername = 'DP'.$generatedUsername;

		// Fetch id from Sponser_id/placement-id
		$sponserId = $this->getUserDetailsByUser($sponserId)->id;
		$placementId = $this->getUserDetailsByUser($placementId)->id;

		try {
			// USER table entry
			$data = array(
				'username' => $newUsername,
				'sponser_id' => $sponserId,
				'placement_id' => $placementId,
				'placement_position' => $placementPosition,
				'title' => $title,
				'firstname' => $firstName,
				'middlename' => $middleName,
				'lastname' => $lastName,
				'date_of_birth' => $dob,
				'gender' => $gender,
				'mobile' => $contact,
				'email' => $email,
				'location' => $location,
				'landmark' => $landmark,
				'city' => $city,
				'district' => $district,
				'state' => $state,
				'pin_code' => $pincode,
				'country' => $country,
				'created_date' => date('Y-m-d h:i:sa')
			);
			$this->db->insert('user',$data);

			$user_id = $this->db->insert_id();
			if($user_id) {
				// LOGIN table entry
				$this->insertLogin($newUsername, $password);

				// USER_BANK_ACCOUNT table entry
				$this->saveBankDetails($user_id, $pan);

				// USER_WALLET
				$this->saveUserWallet($user_id);

				// JOINING DETAILS
				$this->saveJoiningDetails($user_id, $joining_amount);

				return $newUsername;
			}
		} catch (Exception $e) {
			// $this->db->trans_rollback();
			// alert the user.
			echo 'User is not registered successfully. Please contact administrator.';
			var_dump($e->getMessage());
		}
		return $newUsername;
	}

	public function saveJoiningDetails($user_id, $joining_amount) {
		$joining_details_data = array(
			'sponser_id' => $user_id,
			'newly_created_user_id' => $user_id,
			'joining_date' =>date('Y-m-d h:i:sa'),
			'joining_amount' => $joining_amount,
			'created_at' => date('Y-m-d h:i:sa')
		);
		$this->db->insert('joining_details',$joining_details_data);
	}

	public function saveUserWallet($user_id) {
		$user_wallet_data = array(
			'user_id'  => $user_id,
			'shopping_fund' => 5000,
			'profit_sharing_value' => 100000,
			'daily_profit' => 0,
			'direct_referral_income' => 0,
			'created_at' => date('Y-m-d h:i:sa')
		);
		$this->db->insert('user_wallet', $user_wallet_data);
	}

	public function saveBankDetails($user_id, $pan) {
		$bank_account_data = array(
			'user_id'	 =>  $user_id,
			'pan_number' => $pan,
			'created_at' => date('Y-m-d h:i:sa')
		);             
		$this->db->insert('bank_details',$bank_account_data);
	}

	public function insertLogin($newUsername, $password) {
		$login_data = array(
			'username' => $newUsername,
			'password' => sha1($password),
			'created_at' => date('Y-m-d h:i:sa')
		);
		$this->db->insert('login',$login_data);
	}

	public function getUserByPlacementId($placementId) {
		$result = $this->db->query("select  id, username,
											firstname, lastname,
											placement_id, placement_position
									from    (select * from user
											order by placement_id, placement_position desc, id) user,
											(select @pv := '$placementId') initialisation
									where   find_in_set(placement_id, @pv) > 0
									and     @pv := concat(@pv, ',', id)");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return [];
	} 

	public function getUser($id) {
		$result = $this->db->query("SELECT * FROM user WHERE id = '$id'");
		if($result->num_rows() > 0) {
			return $result->row();
		}
		return null;
	}

	public function getAllUserByActiveAndDeleted($accountStatus, $deleted) {
		$result = $this->db->query("SELECT user.* FROM user INNER JOIN login ON user.username = login.username WHERE account_is_active = '$accountStatus' and deleted is $deleted and user_role= 'USER' ");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return [];
	}

	public function updateUserWallet($userWallet) {
		$this->db->where('user_id', $userWallet->user_id);
		return $this->db->update('user_wallet', $userWallet);
	}

	public function insertUserWalletDefault($user_id) {
		$user_wallet_data = array(
			'user_id'  => $user_id,
			'shopping_fund' => 5000,
			'profit_sharing_value' => 100000,
			'daily_profit' => 0,
			'direct_referral_income' => 0,
			'created_at' => date('Y-m-d h:i:sa')
		);
		$this->db->insert('user_wallet', $user_wallet_data);
	}

	public function getUserWalletByUserId($userId) {
		$result = $this->db->query("SELECT * FROM user_wallet where user_id = $userId ");
		if($result->num_rows() > 0) {
			return $result->row();
		}
		return null;
	}

	public function getPersonalDetails($userId) {
		$result = $this->db->query("SELECT * FROM user INNER JOIN bank_details bank ON user.id = bank.user_id 
		WHERE user.id = $userId ");
		if($result->num_rows() > 0) {
			return $result->row();
		}
		return null;
	}

	public function updateUser(
		$firstName, $middleName, $lastName, $dob, $gender, $mobile, $email, $location, $landmark, $city, $district, $state, $pincode, $country, $userId) {
			$user = array(
				'firstname' => $firstName,
				'middlename' => $middleName,
				'lastname' => $lastName,
				'date_of_birth' => $dob,
				'gender' => $gender,
				'mobile' => $mobile,
				'email' => $email,
				'location' => $location,
				'landmark' => $landmark,
				'city' => $city,
				'district' => $district,
				'state' => $state,
				'pin_code' => $pincode,
				'country' => $country
			);
			$this->db->where('id', $userId);
			$isUpdated = $this->db->update('user', $user);
			return $isUpdated;
	}

	public function updateBankDetails($Pan, $BankName, $BankBranch, $BankIFSCCode, $AccountNo, $userId, $accountType) {
		$data = array(
			'pan_number' => $Pan,
			'bank_name' => $BankName,
			'bank_branch' => $BankBranch,
			'bank_ifsc' => $BankIFSCCode,
			'account_number' => $AccountNo,
			'account_type' => $accountType
		);
		$this->db->where('user_id', $userId);
		$isUpdated = $this->db->update('bank_details', $data);
		return $isUpdated;
	}

	public function changePassword($NewPassword, $username) {
		$data = array(
			'password' => $NewPassword
		);
		$this->db->where('username', $username);
		return $this->db->update('login', $data);
	}

	public function getAllChildsByPlacementIdAndSide($placementId, $placementPosition) {
		$result = $this->db->query("SELECT * FROM user WHERE placement_id = $placementId AND placement_position = '$placementPosition'");
		if($result->num_rows() > 0) {
			$userList = array();
			$rootChild = $result->row();
			$userList = $this->getUserByPlacementId($rootChild->id);
			array_push($userList, $rootChild);
			return $userList;
		}
		return [];
	}

}
?>
