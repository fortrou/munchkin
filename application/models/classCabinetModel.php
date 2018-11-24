<?php 
	class CabinetModel {
		private $mysqli;
		private $userCookie;
		function __construct() {
			global $mysqli;
			global $userCookie;
			$this->mysqli = $mysqli;
			$this->userCookie = $userCookie;
		}
		public function get_usersList($current_role, $user_role = 0) {
			$querySet = "";
			if($user_role == 0) {
				$querySet = sprintf(" AND user_role >= 1 AND user_role < %s", $current_role);
			} else if($user_role > $current_role) {
				$querySet = sprintf(" AND user_role = %s", $current_role);
			} else {
				$querySet = sprintf(" AND user_role = %s", $user_role);
			}
			$sql = sprintf("SELECT * FROM mnc_users 
									WHERE 1 = 1 
										  %s", $querySet);
			$res = $this->mysqli->query($sql);
			$resultArray = array();
			while ($row = $res->fetch_assoc()) {
				$resultArray[] = $row;
			}

			return $resultArray;
		}
	}	


?>