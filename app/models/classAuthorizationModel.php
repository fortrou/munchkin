<?php


class AuthorizationModel extends BaseModel {

	public function __construct() {
		parent::__construct();
	}

	public function check_isLoginUnique($login) {
        $sql = 'SELECT user_login 
                FROM mnc_users 
				WHERE user_login = ?';
        $params = [
            Helper::escape_html($login)
        ];
        if ($this->db->prepare_select($sql, $params)) {
            return false;
        } else return true;
    }

	public function register($data) {
        if(!empty($data["login"]) && !empty($data["password"]) && $data["password"] == $data["password_repeat"]) {
            if ($this->check_isLoginUnique($data["login"])) {
                $insert_sql = 'INSERT INTO mnc_users
                               (user_login, user_password, user_regDate) 
				               VALUES (?, ?, ?)';
                $params = [
                    Helper::escape_html($data["login"]),
                    md5(Helper::escape_html($data["password"])),
                    Date("Y-m-d"),
                ];
                if ($this->db->prepare($insert_sql, $params)) {
                    $this->authorize($data);
                }
            }
        }
        return false;
    }

	public function authorize($data) {
        if(!empty($data["login"]) && !empty($data["password"])) {
            $sql = 'SELECT id, user_nickname, user_role, user_avatar
                    FROM mnc_users
					WHERE user_login = ? AND user_password = ?';
            $params = [
                Helper::escape_html($data["login"]),
                md5( Helper::escape_html($data["password"])),
            ];
            $result = $this->db->prepare_select($sql, $params);
            if (!empty($result)) {
                self::set_authCookie($result[0]);
                header('Location: ' . PROTOCOL . SITE_NAME);
            }
        }
    }

    public function sign_out() {
	    $cookie = new CookieManager('base64_encode', 'base64_decode');
	    $cookie->unset_cookie('user');
        header('Location: ' . PROTOCOL . SITE_NAME);
    }

    public function reload_cookie($id) {
        $sql = 'SELECT id, user_nickname, user_role, user_avatar
                FROM mnc_users
				WHERE id = ?';
        $params = [
            Helper::escape_html($id),
        ];
        $result = $this->db->prepare_select($sql, $params);
        if (!empty($result)) {
            self::set_authCookie($result[0]);
            header('Refresh: 0');
        }
    }

    public static function set_authCookie($user_data) {
        $cookie_name = 'user';
        $cookie = new CookieManager('base64_encode', 'base64_decode');
        $cookie->unset_cookie($cookie_name);
        $cookie->set_user_cookie($cookie_name, $user_data, 60*60*24, '/');
    }

}