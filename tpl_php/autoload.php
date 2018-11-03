<?php
	$str = str_replace('\tpl_php\autoload.php', '', __FILE__);
	if(strpos($str, 'autoload'))
		$str = str_replace('/tpl_php/autoload.php', '', __FILE__);
	require_once("$str/config.php");
	ini_set('display_errors','Off');
	function __autoload($name) {
		require 'class' . $name . '.php';
	}
	require_once "recaptchalib.php";
	$cookieManager = new CookieManager("user-fields", "base64_decode");
	$user_cookie = $cookieManager->get_cookie("user-fields", "base64_decode");
	
 ?>