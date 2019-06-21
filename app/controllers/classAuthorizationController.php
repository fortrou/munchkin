<?php


class AuthorizationController extends BaseController {
	private $authModel;

	function __construct() {
	    parent::__construct();
		$this->authModel = new AuthorizationModel();
	}

	public function init_work($action='') {
        $this->view->render_page('404.php');
	}

	public function get_loginTemplate() {
        if (isset($_POST['sign-in'])) {
            unset($_POST['sign-in']);
            $this->authorize_user($_POST);
        }
	    $this->view->render_page('login-form.php');
	}

	public function get_registerTemplate() {
        if (isset($_POST['register'])) {
            unset($_POST['register']);
            $this->create_user($_POST);
        }
        $this->view->render_page('registration-form.php');
	}

	public function create_user($data = array()) {
	    $this->authModel->reg($data);
	}

	public function authorize_user($data = array()) {
		$this->authModel->auth($data);
	}

	public static function edit_user($data = array()) {
		if(empty($data)) {
			throw new Exception("e_1");
		}
		$result = AuthorizationModel::edit($data);
	}


}