<?php session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('BASE', 'http://localhost:88/BaladaKode/');
define('VIEW_PATH', ROOT.DS.'views');
define('ASSETS', 'assets/');
define('VIEW', 'views/');

require_once(ROOT.DS.'libs'.DS.'loader.php');