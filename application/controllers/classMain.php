<?php
require_once("interfaceInitiator.php");

class Main implements Initiator {
	function __construct() {
		# code...
	}

	public function init_work() {
	    $this->render_mainPage();
	}

	public function render_mainPage() {
		require_once(DOC_ROOT . "/content/templates/main.php");
	}

}