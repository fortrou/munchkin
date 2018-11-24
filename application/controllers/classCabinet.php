<?php
	require_once("interfaceInitiator.php");
	require_once("application/models/classCabinetModel.php");
	require_once("classAuthorization.php");
	
	/**
	* 
	*/
	class Cabinet implements Initiator {
		private $mainModel;
		function __construct() {
			$this->mainModel = new CabinetModel();
		}
		public function init_work($uri) {
			// var_dump($uri);
			$uriArray = explode('/', $uri);
			if($uriArray[0] == 'cabinet' && count($uriArray) == 1) {
				if(method_exists($this, "get_profileTemplate")) {
					$this->get_profileTemplate();
				}
			}
			if($uriArray[0] == 'cabinet' && $uriArray[1] == 'user-list') {
				if(method_exists($this, "get_usersListTemplate")) {
					$this->get_usersListTemplate();
				}
			}
		}
		private function get_profileTemplate() {
			global $appController;
			require_once(DOC_ROOT . "/content/templates/cabinet/profile.php");
		}
		private function get_usersListTemplate() {
			global $appController;
			require_once(DOC_ROOT . "/content/templates/cabinet/admin/users.php");
		}
		private function get_usersList($user_role) {
			return $result = $this->mainModel->get_usersList($_SESSION['user']['user_role'], $user_role);
		}
	}
?>