<?php
	function plural_form($number, $after) {
		$cases = array (2, 0, 1, 1, 1, 2);
		return $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
	}
	
	function get_ip() {
	    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	        $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else {
	        $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}

	/**
	 * cookie_ip_control() ограничение количества обновлений на сайте, исходя из $_COOKIE
	 * $session_required = 1|2, 1 - ограничениение действует для всех, 2 - ограничение действует только для неавторизованых
	 *
	 *
	 **/
	function cookie_ip_control($session_required = 1) {
		$ip = get_ip();
		if(($session_required == 2 && isset($_SESSION['data']) && !empty($_SESSION['data'])) || (strpos($_SERVER['REQUEST_URI'], 'tpl_php') !== false)) {
			return false;
		}
		if(!isset($_COOKIE['ip_trigger'])) {
			setcookie("ip_trigger",1,time()+60);
		} else {
			$amount = $_COOKIE['ip_trigger'];
			if($amount == 8) {
				die("<center><h1 style='color:red'> Try to reload it in a minute</h1></center>");
			} else {
				unset_cookie('ip_trigger');
				$amount++;
				setcookie("ip_trigger",$amount,time()+60);
			}
		}
	}
	function get_header() {
		if(!isset($_SESSION['user'])) {
			require_once(ROOT . '/content/blocks/header.php');
		} else if($_SESSION['user']['user_role'] == 1) {
			require_once(ROOT . '/content/blocks/header-user.php');
		} else if($_SESSION['user']['user_role'] == 2) {
			require_once(ROOT . '/content/blocks/header-admin.php');
		}
	}
	function get_footer() {
		require_once(ROOT . '/content/blocks/footer.php');
	}
	/**
	 * check_array_with_regular() - проверяет соответствие строки массиву паттернов, возвращает ключ => значение
	 * $patterns - Массив паттернов
	 * $string - строка на соответствие
	 *
	 **/
	function check_array_with_regular($patterns = array(), $string = '') {
		if(empty($patterns) || $string == '') return false;
		foreach($patterns as $key => $value) {
			//var_dump(preg_match("~$key~", $string));
			if(preg_match("~$key~", $string)) {
				return array( 0 => $key,
							  1 => $value );
			}
		}
	}
?>