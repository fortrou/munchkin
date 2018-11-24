<?php
	define('ROOT',dirname(__FILE__));
	define('PROTOCOL', "http://");
	define('SITE_NAME', "munchkin.test/");
	define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);
	define('REQUEST_URI', $_SERVER['REQUEST_URI']);
	if(!empty($_SERVER['HTTP_REFERER'])) $referer = $_SERVER['HTTP_REFERER'];
	else $referer = "";
	define('REFERER_URI', $referer);
	define('BLOCK_FOLDER', ROOT . "/tpl_blocks/");
	define('AVATARS',  PROTOCOL . SITE_NAME . "content/images/avatars/");
	define('AVATARS_UPLOAD',  ROOT . "/content/images/avatars/");

	//DATABASE CONNECTION

	define("DATABASE", "munchkin_db");
	define("DB_USER", "root");
	define("DB_PASSWORD", "");
?>