<?php
	require_once("interfaceInitiator.php");
	require_once("application/models/classAuthorizationModel.php");
	/**
	* 
	*/
	class Authorization implements Initiator {
		private $mainModel;
		function __construct() {
			$this->mainModel = new AuthorizationModel();
		}

		public function init_work($action='') {			
			header("Location: /404.php");
		}
		public function get_loginTemplate() {
			global $appController;
			require_once(DOC_ROOT . "/content/templates/login-form.php");
		}
		public function get_registerTemplate() {
			global $appController;
			require_once(DOC_ROOT . "/content/templates/registration-form.php");
		}
		
		public function create_user($data = array()) {
				print_r($data);
			if(empty($data)) {
				throw new Exception("e_1");
			}
			// var_dump($data);
			$result = $this->mainModel->register($data);
				
		}

		public function authorize_user($data = array()) {
			if(empty($data)) {
				throw new Exception("e_1");
			}
			$result = $this->mainModel->authorize($data);
		}
		public static function edit_user($data = array()) {
			if(empty($data)) {
				throw new Exception("e_1");
			}
			$result = AuthorizationModel::edit($data);
		}
	}

?>