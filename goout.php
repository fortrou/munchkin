<?php
session_start();
unset($_SESSION['user']);
$cookie_name = 'user';
setcookie($cookie_name, "", time()-1000*60*60*24*7 );
setcookie($cookie_name, "", time()-1000*60*60*24*7, '/');
$flag = true;
while($flag) {
	if(isset($_COOKIE[$cookie_name])) {
		setcookie($cookie_name, "", time()-1000*60*60*24*7 );
		$flag = false;
	}
}
header('Location: ' . PROTOCOL . SITE_NAME);
?>