<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Europe/Warsaw');

if (!version_compare(PHP_VERSION, '5.3.7', '>=')) {
	echo '<!-- php v. 5.3.7 minimum required! -->';
	die;
}

define('DS',   		DIRECTORY_SEPARATOR);
define('ROOT', 		dirname(__FILE__) . DS);
define('LIB',  		ROOT . 'lib' . DS);
define('APP_DIR', 	'app');
define('APP', 		ROOT . APP_DIR . DS);

require LIB . 'bootstrap.php';

CMS_Autoload::register();

define('URL', 'http://localhost/zadanie/');

include APP . 'start.php';