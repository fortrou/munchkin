<?php


class SessionManager
{

    public function __construct() {
    }

    public static function add_cookieToSession($name) {
        if (isset($_COOKIE[$name]) && !empty($_COOKIE[$name])) {
            $user_cookie = new CookieManager( 'base64_encode', 'base64_decode');
            $current_user = $user_cookie->get_cookie($name);
            if(!empty($current_user)) {
                $_SESSION[$name] = unserialize($current_user);
            }
        } else unset($_SESSION[$name]);
    }
}