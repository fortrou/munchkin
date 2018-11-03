<?php
	require_once('/tpl_php/autoload.php');
	$url = PROTOCOL . SITE_NAME . REQUEST_URI;
	$requestUri = REQUEST_URI;
	$app = new App($url, $requestUri);
	$app->parse_uri();
?>
