<?php
	class AuthorizationModel {
		private $mysqli;
		private $userCookie;
		function __construct() {
			global $mysqli;
			global $userCookie;
			$this->mysqli = $mysqli;
			$this->userCookie = $userCookie;
		}
		public function register($data = array()) {
			if(!empty($data["login"]) && !empty($data["password"]) && $data["password"] == $data["password_repeat"]) {
				$sql = sprintf("SELECT user_login FROM mnc_users
											     WHERE user_login = '%s'", $data["login"]);
				$res = $this->mysqli->query($sql);
				if(!$res->num_rows) {
					$sql = sprintf("INSERT INTO mnc_users(user_login, user_password, user_regDate) 
									     VALUES ('%s', '%s', '%s')", 
								htmlspecialchars(strip_tags($data["login"])), md5(htmlspecialchars(strip_tags($data["password"]))), Date("Y-m-d"));
					$res = $this->mysqli->query($sql);
					if($this->mysqli->affected_rows > 0) return true;
				}
				throw new Exception("e_2");
			}
			throw new Exception("e_3");
			
		}
		public function authorize($data = array()) {
			if(!empty($data["login"]) && !empty($data["password"])) {
				$data["password"] = md5(htmlspecialchars(strip_tags($data["password"])));
				$sql = sprintf("SELECT * FROM mnc_users
										WHERE user_login = '%s' AND user_password = '%s'", htmlspecialchars(strip_tags($data["login"])), $data["password"]);
				$res = $this->mysqli->query($sql);
				if($res->num_rows == 1) {
					$row = $res->fetch_assoc();
					$this->userCookie->set_user_cookie('user', $row, (3600*24));
				}

			}

		}	
		public static function edit($data = array()) {
			global $mysqli;
			$updExpression = '';
			if(!empty($_FILES['user_avatar'])) {
				if(Cfile::isSecure($_FILES['user_avatar'])){
					$name = Cfile::Load($_FILES['user_avatar'], AVATARS_UPLOAD);
					if($name) $updExpression .= "user_avatar = '" . $name . "', ";
				}
			}
			foreach($data as $key => $value) {
				if(in_array($key, array('user_login', 'user_password', 'user_role', 'id', 'user_regDate', 'change'))) continue;
				if(!is_numeric($value))
					$updExpression .= $key . "='" . $value . "', ";
				else
					$updExpression .= $key . "=" . $value . ", ";
			}
			$updExpression = rtrim($updExpression, ', ');
			$sql = sprintf("UPDATE mnc_users
							   SET %s
							 WHERE id = %s", $updExpression, $_SESSION['user']['id']);
			$res = $mysqli->query($sql);
			if($mysqli->affected_rows > 0) {
				AuthorizationModel::reload_sessionAndCookie($_SESSION['user']['id']);
			}
		}
		public static function reload_sessionAndCookie($id) {
			global $mysqli;
			global $userCookie;
			if(!empty($id)) {
				$sql = sprintf("SELECT * FROM mnc_users
										WHERE id = %s", $id);
				$res = $mysqli->query($sql);
				if($res->num_rows == 1) {
					$row = $res->fetch_assoc();
					$userCookie->unset_cookie('user');
					$userCookie->set_user_cookie('user', $row, (3600*24));
				}

			}
		}
	}
?>