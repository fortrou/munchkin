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
		}
		private function get_profileTemplate() {
			global $appController;
			require_once(DOC_ROOT . "/content/templates/cabinet/profile.php");
		}
	}
?>