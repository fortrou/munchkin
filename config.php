<?php

const ROOT = __DIR__;
const PROTOCOL = 'http://';
const SITE_NAME = 'munchkin.test/';
define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('REQUEST_URI', $_SERVER['REQUEST_URI']);
define('REFERER_URI', $referer = $_SERVER['HTTP_REFERER'] ?: '');

const APP_DIR = ROOT . '/app';
const BLOCK_DIR =  ROOT . '/content/blocks/';

const AVATARS =   PROTOCOL . SITE_NAME . 'content/images/avatars/';
const AVATARS_UPLOAD =  ROOT . '/content/images/avatars/';

//DATABASE CREDITS

const DATABASE = 'munchkin_db';
const DB_USER = 'root';
const DB_PASSWORD = '';