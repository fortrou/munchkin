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
		private $action;

		function __construct($url, $uri = '') {
			if(empty($url)) return false;
			$this->currentUrl = $url;
			$this->currentUri = $uri;
		}
		private function object_to_array($obj) {
		    //only process if it's an object or array being passed to the function
		    if(is_object($obj) || is_array($obj)) {
		        $ret = (array) $obj;
		        foreach($ret as &$item) {
		            //recursively process EACH element regardless of type
		            $item = $this->object_to_array($item);
		        }
		        return $ret;
		    }
		    //otherwise (i.e. for scalar values) return without modification
		    else {
		        return $obj;
		    }
		}
		public function parse_uri() {
			// Keys array
			// $keysArray = array('', 'cabinet', 'game', 'registration', 'login');
			
			// Processing URI
			// if(file_exists('config.xml')) die('here');
			$keys_array = $this->object_to_array(simplexml_load_file('config.xml'));
			$routers = $keys_array['routers'];
			/*echo "<pre>";
			var_dump($routers);
			echo "</pre>";*/
//			die();
			$this->currentUri = ltrim($this->currentUri, '/');
			$uriArray = explode('/', $this->currentUri);
			// var_dump($this->currentUri);
			// die;
			// Redirection to 404 page if not in keys array 
			if($this->currentUri == '') {
				// var_dump("dasdas");
				$controller = "Main";
			} else if($routers[$uriArray[0]]) {
				$controller = $routers[$uriArray[0]]["controller"]["initController"];
				/*var_dump($controller);
				die;*/
				if($uriArray[1]){
					$this->action = $routers[$uriArray[0]]["controller"][$uriArray[1]]["initAction"];
				}
				/*var_dump($controller);
				var_dump($this->action);die;*/
			}
			else header("Location: /404.php");

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
			$actionToLoad = '';
			if($this->action) {
				$actionToLoad = $this->action;
			} else {
				$actionToLoad = "init_work";
			}
			if(file_exists("application/controllers/class" . $controller . ".php")) {
				require_once("application/controllers/class" . $controller . ".php");
				$appController = new $controller();
				$appController->$actionToLoad($this->action);

			}

		}

	}

?>