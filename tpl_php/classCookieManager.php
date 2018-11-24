<?php
	class CookieManager {
		private $cookie_data = array();
		private $encode_method;
		private $decode_method;

		//конструктор-парсер куки
		function __construct($cookie_name, $encode_method, $decode_method) {
			$this->encode_method = $encode_method;
			$this->decode_method = $decode_method;
			$decode = $decode_method;
			if(isset($_COOKIE[$cookie_name]) && !empty($_COOKIE[$cookie_name])) {
				$this->cookie_data = $decode($_COOKIE[$cookie_name]);
			}
		}
		//установка кук
		public function set_user_cookie($name, $value, $time = 0) {
			if(empty($name) || empty($value) || $time < 1) return false;
			if(is_array($value)) {
				$value = serialize($value);
			}
			$encode = $this->encode_method;
			$value = $encode($value);
			$result = setcookie($name, $value, time() + $time);
		}
		//удаление кук
		public function unset_cookie($cookie_name = '') {
			if($cookie_name == '') return false;
			setcookie($cookie_name, "", time()-1000*60*60*24*7 );
			setcookie($cookie_name, "", time()-1000*60*60*24*7, '/');
			$flag = true;
			while($flag) {
				if(isset($_COOKIE[$cookie_name])) {
					setcookie($cookie_name, "", time()-1000*60*60*24*7 );
					$flag = false;
				}
			}
			return false;
		}
		public function get_cookie($name) {
			$decode = $this->decode_method;
			if(isset($_COOKIE[$name]) && !empty($_COOKIE[$name])) {
				return $decode($_COOKIE[$name]);
			} else {
				return array();
			}
		}
	}
?>