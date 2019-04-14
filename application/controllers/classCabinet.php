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
			if($uriArray[0] == 'cabinet' && count($uriArray) == 1) {
				if(method_exists($this, "get_profileTemplate")) {
					$this->get_profileTemplate();
				}
			}
		}
		public function get_profileTemplate() {
			global $appController;
			require_once(DOC_ROOT . "/content/templates/cabinet/profile.php");
		}
		public function get_usersListTemplate() {
			global $appController;
			require_once(DOC_ROOT . "/content/templates/cabinet/admin/users.php");
		}
		public function get_usersList($user_role) {
			return $result = $this->mainModel->get_usersList($_SESSION['user']['user_role'], $user_role);
		}
		public function get_decksTemplate() {
			global $appController;
			$decks = new DeckModel();
			$result = $decks->get_deckList();
			echo "<pre>";
			var_dump($result);
			echo "</pre>";
			require_once(DOC_ROOT . "/content/templates/cabinet/decks.php");
		}
		public function get_decksCreateTemplate() {
			global $appController;
			$decks = new DeckModel();
			require_once(DOC_ROOT . "/content/templates/cabinet/decks_create.php");

		}
	}
?>