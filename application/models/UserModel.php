<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model 
{   
	function __CONSTRUCT() {
	}

	public function getUserDetailsByUser($username) {
		$result = $this->db->query("SELECT * FROM user WHERE username = '$username'");
		if($result->num_rows() > 0) {
			return $result->row();
		}
		return null;
	}

	public function registerUser($sponserId, $placementId, $placementPosition, $title, $firstName, $middleName, $lastName, $dob, $gender, $contact, $email, $pan, 
		$location, $landmark, $city, $district, $state, $pincode, $country, $password) {
			
		// GENERATE USERNAME	
		$digits = 6;
		$generatedUsername = rand(pow(10, $digits-1), pow(10, $digits)-1);
		$newUsername = 'DP'.$generatedUsername;

		// Fetch id from Sponser_id/placement-id
		$sponserId = $this->getUserDetailsByUser($sponserId)->id;
		$placementId = $this->getUserDetailsByUser($placementId)->id;

		// $this->db->trans_begin();
		
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
				// echo 'inserted '.$user_id;
				// LOGIN table entry
				$login_data = array(
					'username' => $newUsername,
					'password' => sha1($password),
					'created_at' => date('Y-m-d h:i:sa')
				);
				$this->db->insert('login',$login_data);
				
				// USER_BANK_ACCOUNT table entry
				$bank_account_data = array(
					'user_id'	 =>  $user_id,
					'pan_number' => $pan,
					'created_at' => date('Y-m-d h:i:sa')
				);             
				$this->db->insert('bank_details',$bank_account_data);

				// USER_WALLET
				$user_wallet_data = array(
					'user_id'  => $user_id,
					'shopping_fund' => 5000,
					'profit_sharing_value' => 100000,
					'deposited_profit_sharing_value' => 0,
					'direct_referral_income' => 0,
					'created_at' => date('Y-m-d h:i:sa')
				);
				$this->db->insert('user_wallet', $user_wallet_data);

				// JOINING DETAILS
				$joining_details_data = array(
					'sponser_id' => $user_id,
					'newly_created_user_id' => $user_id,
					'joining_date' =>date('Y-m-d h:i:sa'),
					'joining_amount' => 10000,
					'created_at' => date('Y-m-d h:i:sa')
				);
				$this->db->insert('joining_details',$joining_details_data);

				// $this->db->trans_complete();

				// if ($this->db->trans_status() === FALSE) {
				// 	$this->db->trans_rollback();
				// } else {
				// 	$this->db->trans_commit();
				// }

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

	public function getUserDetailsById($id) {
		$result = $this->db->query("SELECT * FROM user WHERE id = '$id'");
		if($result->num_rows() > 0) {
			return $result->row();
		}
		return null;
	}
}
?>
