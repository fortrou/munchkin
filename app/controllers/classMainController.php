<?php


class MainController extends BaseController {
	function __construct() {
		parent::__construct();
	}

	public function init_work() {
	    $this->render_mainPage();
	}

	public function render_mainPage() {
	    $this->view->render_page('main.php');
	}

}