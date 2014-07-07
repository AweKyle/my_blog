<?php
header("Content-Type:text/html; Charset=utf-8");

error_reporting(E_ALL);

define('DIRSEP', DIRECTORY_SEPARATOR);

$site_path = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP;

define('site_path', $site_path);

//require 'dbconn.php';

function __autoload($class_name)
{
	$filename = strtolower($class_name) . '.php';
	$file = site_path . 'protected' . DIRSEP . 'models' . DIRSEP . $filename;
	if (file_exists($file) == false) {
		return false;
	} else {
		include $file;
	}
}