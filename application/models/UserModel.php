<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model 
{   
	function __CONSTRUCT() {
		date_default_timezone_set('Asia/Kolkata');
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
				'created_date' => date('Y-m-d H:i:s')
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

				// DEFAULT ENTRY FOR COUNT OF DIRECT REFERRAL
				$this->saveUserDirectReferral($user_id);

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
		$this->db->insert('joining_details', $joining_details_data);
	}

	public function saveUserDirectReferral($user_id) {
		$user_direct_referral_mapping_data = array(
			'user_id' => $user_id,
			'direct_referrals' => 0,
			'created_date' => date('Y-m-d h:i:sa')
		);
		$this->db->insert('user_direct_referral_mapping', $user_direct_referral_mapping_data);
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

	public function getUserForProfitSharing($accountStatus, $deleted, $userId) {
		$result = $this->db->query("SELECT user.*, referral.direct_referrals as direct_referral FROM user INNER JOIN login ON user.username = login.username LEFT JOIN user_direct_referral_mapping referral on user.id = referral.user_id WHERE account_is_active = '$accountStatus' and deleted is $deleted and user_role= 'USER' AND referral.direct_referrals < 2 AND user.id NOT IN ($userId) order by user.id ");
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

	public function insertProfitSharingHistory($user_id, $new_user_id, $transaction_date, $transaction_amount, $transaction_remark, $created_date) {
		$profit_sharing = array(
			'user_id' => $user_id,
			'new_user_id' => $new_user_id,
			'transaction_date' => $transaction_date,
			'transaction_amount' => $transaction_amount,
			'transaction_remark' => $transaction_remark,
			'created_date' => $created_date
		);
		$this->db->insert('profit_sharing_history', $profit_sharing);
	}

	public function getProfitSharingHistoryByUserId($user_id) {
		$result = $this->db->query("SELECT * FROM profit_sharing_history WHERE user_id = $user_id ORDER BY id ");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return [];
	}

	public function insertDirectReferralHistory($user_id , $new_user_id , $transaction_date , $transaction_amount , $transaction_remark , $created_date) {
		$direct_referral = array(
			'user_id' => $user_id,
			'new_user_id' => $new_user_id,
			'transaction_date' => $transaction_date,
			'transaction_amount' => $transaction_amount,
			'transaction_remark' => $transaction_remark,
			'created_date' => $created_date
		);
		$this->db->insert('direct_referral_history', $direct_referral);
	}

	public function getDirectReferralHistoryByUserId($user_id) {
		$result = $this->db->query("SELECT * FROM direct_referral_history WHERE user_id = $user_id ORDER BY id ");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return [];
	}

	public function insertBinaryIncomeHistory($user_id , $new_user_id , $pair_match, $transaction_date , $transaction_amount , $transaction_remark , $created_date) {
		$binary_income = array(
			'user_id' => $user_id,
			'new_user_id' => $new_user_id,
			'pair_match' => $pair_match,
			'transaction_date' => $transaction_date,
			'transaction_amount' => $transaction_amount,
			'transaction_remark' => $transaction_remark,
			'created_date' => $created_date
		);
		$this->db->insert('binary_income_history', $binary_income);
	}

	public function getBinaryIncomeHistoryByUserId($user_id) {
		$result = $this->db->query("SELECT * FROM binary_income_history WHERE user_id = $user_id AND pair_match > 0 ORDER BY id ");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return [];
	}

	public function getUserBySponserId($sponserId) {
		$result = $this->db->query("SELECT * FROM user WHERE sponser_id = $sponserId ");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return [];
	}

	public function getDirectReferralList($user_id) {
		$result = $this->db->query("SELECT user.*,sponser_user.username as sponser_username, placement_user.username as placement_username FROM user 
									INNER join user sponser_user ON sponser_user.id = user.sponser_id
									INNER join user placement_user ON placement_user.id = user.placement_id
									WHERE user.sponser_id IN ($user_id) ");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return [];
	}

	public function getDirectReferralUserMappingByUserId($user_id) {
		$result = $this->db->query("SELECT * FROM user_direct_referral_mapping WHERE user_id = $user_id ");
		if($result->num_rows() > 0) {
			return $result->row();
		}
		return null;
	}

	public function updateDirectReferralMapping($user_id, $direct_referrals) {
		$user_direct_referral_mapping_data = array(
			'direct_referrals' => $direct_referrals
		);
		$this->db->where('user_id', $user_id);
		return $this->db->update('user_direct_referral_mapping', $user_direct_referral_mapping_data);
	}

	public function getGroupListByUserList($user_id) {
		$result = $this->db->query("SELECT user.*,sponser_user.username as sponser_username, placement_user.username as placement_username FROM user 
									LEFT join user sponser_user ON sponser_user.id = user.sponser_id
									LEFT join user placement_user ON placement_user.id = user.placement_id
									WHERE user.id IN ($user_id) ORDER BY id ");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return [];
	}

	public function getUserLevelByUserId($userId, $childUserId) {
		$result = $this->db->query("SELECT * FROM (SELECT  @r AS _id,
											(
											SELECT  @r := placement_id
											FROM    user
											WHERE   id = _id
											) AS parent,
											@l := @l + 1 AS lvl
									FROM    (
											SELECT  @r := '$childUserId',
													@l := 0,
													@cl := 0
											) vars,	
											user h
									WHERE    @r <> 0) as aa
									where _id = '$userId'");
		if($result->num_rows() > 0) {
			return $result->row()->lvl;
		}
		return null;
	}
}
?>
