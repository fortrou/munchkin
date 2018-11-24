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
	}	


?>