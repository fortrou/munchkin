<?php


class AuthorizationModel extends BaseModel {

	public function __construct() {
		parent::__construct();
	}

	public function reg($data) {
        if(!empty($data["login"]) && !empty($data["password"]) && $data["password"] == $data["password_repeat"]) {
            $insert_sql = 'INSERT INTO mnc_users
                           (user_login, user_password, user_regDate) 
				           VALUES (?, ?, ?)';
            $params = [
                'sss',
                Helper::escape_html($data["login"]),
                md5( Helper::escape_html($data["password"])),
                Date("Y-m-d"),
            ];
            $result = $this->db->prepare($insert_sql, $params);
        }
        return $result ?? false;
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

	public function auth($data) {
        if(!empty($data["login"]) && !empty($data["password"])) {
            $sql = 'SELECT *
                    FROM mnc_users
					WHERE user_login = ? AND user_password = ?';
            $params = [
                'ss',
                Helper::escape_html($data["login"]),
                md5( Helper::escape_html($data["password"])),
            ];
            $result = $this->db->prepare_select($sql, $params);
            if (!empty($result)) {
                //$cookie_manager = new CookieManager('user', 'base64_encode', 'base64_decode');
                //$cookie_manager->set_user_cookie('user', $result[0], 3600*24);
                setcookie('user', serialize($result[0]), time() + 3600*24, '/');
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