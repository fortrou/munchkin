<?php


class CookieManager {

	private $encode_method;
	private $decode_method;

	//конструктор-парсер куки
	public function __construct($encode_method, $decode_method) {
		$this->encode_method = $encode_method;
		$this->decode_method = $decode_method;
	}

	//установка кук
	public function set_user_cookie($name, $value, $time = 0, $path = '/') {
		if(empty($name) || empty($value) || $time < 1) return false;

		if(is_array($value) || is_object($value)) {
			$value = serialize($value);
		}

		$encode = $this->encode_method;
		$value = $encode($value);
		return setcookie($name, $value, time() + $time, $path);
	}

	//удаление кук
	public function unset_cookie($cookie_name) {
		setcookie($cookie_name, '', 1);
		setcookie($cookie_name, '', 1, '/');
//		$flag = true;
//		while($flag) {
//			if(isset($_COOKIE[$cookie_name])) {
//				setcookie($cookie_name, '', 1);
//				$flag = false;
//			}
//		}
//		return true;
	}

	public function get_cookie($name) {
		$decode = $this->decode_method;
		return $decode($_COOKIE[$name]) ?? '';
	}

}