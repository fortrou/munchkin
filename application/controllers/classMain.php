<?php
	require_once("interfaceInitiator.php");

	class Main implements Initiator {
		function __construct() {
			# code...
		}

		public function init_work($uri) {
			if(empty($uri)) {
				if(method_exists($this, "render_mainPage")) {
					$this->render_mainPage();
				}
			}
			$uriArray = explode('/', $uri);
			
		}
		public function render_mainPage() {
			require_once(DOC_ROOT . "/content/templates/main.php");
		}

	}
?>