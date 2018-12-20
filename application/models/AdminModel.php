<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminModel extends CI_Model 
{   
	function __CONSTRUCT() {
		//PAYMENT STATUS : NEW, PROCESS, COMPLETED, FAILED, HOLD
	}

	public function getLatestUser() {
		$result = $this->db->query("SELECT user.*, sponser.username as sponser_name,user_role.role FROM user 
									INNER JOIN user sponser 
									ON user.parent_sponser = sponser.id
									INNER JOIN user_role
									ON user.username = user_role.username
									WHERE user_role.role = 'USER'
									order by user.id desc");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}

	public function getAllUser() {
		$result = $this->db->query("SELECT user.*, sponser.username as sponser_name,user_role.role FROM user 
									INNER JOIN user sponser 
									ON user.parent_sponser = sponser.id
									INNER JOIN user_role
									ON user.username = user_role.username
									WHERE user_role.role = 'USER'
									order by user.id");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}

	public function getBlockedUser() {
		$result = $this->db->query("SELECT user.*, sponser.username as sponser_name,user_role.role FROM user 
									INNER JOIN user sponser 
									ON user.parent_sponser = sponser.id
									INNER JOIN user_role
									ON user.username = user_role.username
									WHERE user_role.role = 'USER' AND user.account_is_active = 'BLOCKED'
									order by user.id");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}

	public function saveGeneratedEpin($E_Pin, $username) {
		$data = array(
			'sponser_user' => $username,
			'e_pin' => $E_Pin,
			'created_date'=> date('Y-m-d h:i:s')
		);
		$this->db->insert('e_pins',$data);
		return $this->db->insert_id();
	}

	public function saveGeneratedEpinHistory($E_Pin, $username) {
		$data = array(
			'parent' => $username,
			'child' => $username,
			'e_pin' => $E_Pin,
			'created_date'=> date('Y-m-d h:i:s')
		);
		$this->db->insert('e_pins_history',$data);
		return $this->db->insert_id();
	}

	public function getPins($isUsed) {
		if($isUsed == 'true') {
			$result = $this->db->query("SELECT * FROM e_pins WHERE used_user IS NOT NULL order by id");
		} else {
			$result = $this->db->query("SELECT * FROM e_pins WHERE used_user IS NULL order by id ");
		}
		
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}

	public function getPinsByUsername($isUsed, $username) {
		if($isUsed == 'true') {
			$result = $this->db->query("SELECT * FROM e_pins WHERE used_user IS NOT NULL AND sponser_user = '$username' order by id");
		} else {
			$result = $this->db->query("SELECT * FROM e_pins WHERE used_user IS NULL AND sponser_user = '$username' order by id ");
		}
		
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}

	public function getAvailablePins($username) {
		$result = $this->db->query("SELECT * FROM e_pins WHERE used_user IS NULL AND sponser_user = '$username' order by id ");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}

	public function getPinDetailsByPin($E_Pin) {
		$result = $this->db->query("SELECT * FROM users_e_pin 
									WHERE users_e_pin.e_pin = $E_Pin");
		if($result->num_rows() > 0) {
			return $result->row();
		}
		return null;
	}

	public function getLastChildByPin($E_Pin) {
		$result = $this->db->query("SELECT * FROM e_pins WHERE e_pins.e_pin = $E_Pin AND e_pins.istransferredFromParent is true");
		if($result->num_rows() > 0) {
			return $result->row();
		}
		return null;
	}

	public function getPayoutRequestDetails() {
		$result = $this->db->query("SELECT payment_detail.*, user.name FROM payment_detail 
									INNER JOIN user ON payment_detail.user_id = user.id 
									WHERE status IN ('NEW', 'HOLD', 'PROCESS')");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}

	public function updateEpinUserMapping($transferToUser, $e_pin, $e_pin_id) {
		$data = array(
			'sponser_user' => $transferToUser
		);
		$this->db->where('id', $e_pin_id);
		return $this->db->update('e_pins', $data);	
	}

	public function AddEpinHistory($e_pin, $username, $transferToUser) {
		$data = array(
			'parent' => $username,
			'child' => $transferToUser,
			'e_pin' => $e_pin,
			'created_date'=> date('Y-m-d h:i:s')
		);
		$this->db->insert('e_pins_history',$data);
		return $this->db->insert_id();
	}

	public function getBankDetailsByUserIdList($userIdList) {
		$result = $this->db->query("SELECT payment_detail.redeem_amount, payment_detail.status as paymentStatus, bank.*, user.name 
				FROM user INNER JOIN bank_details bank ON bank.username = user.username 
				INNER JOIN payment_detail ON payment_detail.user_id = user.id 
				WHERE user.deleted is false AND user.account_is_active != 'INTERNAL' AND user.id IN ($userIdList)
				AND payment_detail.status IN ('COMPLETED') ");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}

	public function printBankDetailsByUserIdList($userIdList) {
		$result = $this->db->query("SELECT payment_detail.redeem_amount, payment_detail.status as paymentStatus, bank.*, user.name 
				FROM user INNER JOIN bank_details bank ON bank.username = user.username 
				INNER JOIN payment_detail ON payment_detail.user_id = user.id 
				WHERE user.deleted is false AND user.account_is_active != 'INTERNAL' AND user.id IN ($userIdList) 
				AND payment_detail.status IN ('COMPLETED', 'FAILED', 'HOLD') ");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}

	public function getPayoutRequestDetailsByPaymentId($paymentId) {
		$result = $this->db->query("SELECT payment_detail.*, user.name FROM payment_detail 
									INNER JOIN user ON payment_detail.user_id = user.id 
									WHERE payment_detail.id = $paymentId");
		if($result->num_rows() > 0) {
			return $result->row();
		}
		return null;
	}

	public function getPaymentHistoryDetails() {
		$result = $this->db->query("SELECT payment_detail.*, user.name, user.username
				FROM user INNER JOIN payment_detail ON payment_detail.user_id = user.id 
				WHERE user.account_is_active != 'INTERNAL' 
				AND payment_detail.status IN ('COMPLETED', 'FAILED', 'HOLD') ");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}

	public function updatePaymentStatus($paymentId, $paymentStatus) {
		$data = array(
			'status' => $paymentStatus
		);
		$this->db->where('id', $paymentId);
		return $this->db->update('payment_detail', $data);
	}

	
	public function getAllPaymentDeposits() {
		$result = $this->db->query("SELECT * FROM payment_detail order by redeem_date desc");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}

	public function getAllTopupDetails() {
		$result = $this->db->query("SELECT * FROM user_topup_user order by created_date desc");
		if($result->num_rows() > 0) {
			return $result->result();
		}
		return null;
	}
}
?>
