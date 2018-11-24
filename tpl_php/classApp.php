<?php
	/**
	 * dev by @fortrou, @itachinight
	 * class Application basic 
	 * private: currentUrl, currentUri 
	 * methods: parse_uri, parse_config, connect_database
	 *
	 **/
	class App {
		private $currentUrl;
		private $currentUri;

		function __construct($url, $uri = '') {
			if(empty($url)) return false;
			$this->currentUrl = $url;
			$this->currentUri = $uri;
		}
		public function parse_uri() {
			// Keys array
			$keysArray = array('', 'cabinet', 'game', 'registration', 'login');
			
			// Processing URI
			$this->currentUri = ltrim($this->currentUri, '/');
			$uriArray = explode('/', $this->currentUri);
			
			// Redirection to 404 page if not in keys array 
			if(!in_array($uriArray[0], $keysArray)) header("Location: /404.php");

			if(in_array($uriArray[0], array('registration', 'login'))) $controller = "Authorization";
			else if($this->currentUri == '') $controller = "Main";
			else $controller = $uriArray[0];
			// file checking
			
			// GLOBAL VARS

			$db = Database::getInstance();
			global $mysqli;
			$mysqli = $db->getConnection();
			global $appController;
			global $userCookie;
			$userCookie = new CookieManager('user', 'base64_encode', 'base64_decode');
			$currentUser = $userCookie->get_cookie('user');
			if(!empty($currentUser)) {
				$_SESSION['user'] = unserialize($currentUser);
			}
			// var_dump($_SESSION);
			// GLOBAL VARS
			
			if(file_exists("application/controllers/class" . $controller . ".php")) {
				require_once("application/controllers/class" . $controller . ".php");
				$appController = new $controller();
				$appController->init_work($this->currentUri);

			}



		}

	}

?>