<?php
	require_once("interfaceInitiator.php");
	require_once("application/models/classCabinetModel.php");
	require_once("classAuthorization.php");
	require_once("application/models/classDeckModel.php");
	
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
			if($uriArray[0] == 'cabinet' && $uriArray[1] == 'decks' && $uriArray[2] == 'create') {
				if(method_exists($this, "get_decksCreateTemplate")) {
					$this->get_decksCreateTemplate();
				}
			} else if($uriArray[0] == 'cabinet' && $uriArray[1] == 'decks') {
				if(method_exists($this, "get_decksTemplate")) {
					$this->get_decksTemplate();
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
		private function get_decksTemplate() {
			global $appController;
			$decks = new DeckModel();
			$result = $decks->get_deckList();
			echo "<pre>";
			var_dump($result);
			echo "</pre>";
			require_once(DOC_ROOT . "/content/templates/cabinet/decks.php");
		}
		private function get_decksCreateTemplate() {
			global $appController;
			$decks = new DeckModel();
			require_once(DOC_ROOT . "/content/templates/cabinet/decks_create.php");

		}
	}
?>