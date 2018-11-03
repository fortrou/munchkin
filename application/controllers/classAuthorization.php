<?php
	require_once("interfaceInitiator.php");
	/**
	* 
	*/
	class Authorization implements Initiator {
		
		function __construct() {
			# code...
		}

		public function init_work($uri) {

			var_dump($uri);
			$uriArray = explode('/', $uri);
			if($uriArray[0] == 'login') {
				if(method_exists($this, "get_loginTemplate")) {
					$this->get_loginTemplate();
				}
			}

			if($uriArray[0] == 'registration') {
				if(method_exists($this, "get_registerTemplate")) {
					$this->get_registerTemplate();
				}
			}
		}
		private function get_loginTemplate() {
			require_once(DOC_ROOT . "/content/templates/login-form.php");
		}
		private function get_registerTemplate() {
			require_once(DOC_ROOT . "/content/templates/registration-form.php");
		}
		
		public function create_user($data = array()) {
			
		}
	}

?>