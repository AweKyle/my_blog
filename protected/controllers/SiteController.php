<?php
error_reporting(E_ALL);
session_start();
//require 'includes/startup.php';
define('DIRSEP', DIRECTORY_SEPARATOR);

$site_path = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP;

define('site_path', $site_path);

function __autoload($class_name)
{
	$filename = strtolower($class_name) . '.php';
	$file = site_path . DIRSEP . 'models' . DIRSEP . $filename;
	if (file_exists($file) == false) {
		return false;
	} 
	else {
		include $file;
	}
}

__autoload('DB');
__autoload('CheckValues');

if (isset($_POST['registration'])) {
	__autoload('Registration');

	if (isset($_POST['login'], $_POST['pass'], $_POST['pass_confirm'], $_POST['email'])) {
		$registration = new Registration($_POST['login'], $_POST['pass'], $_POST['pass_confirm'], $_POST['email']);

		if (!is_array($registration->addNewUser())) {
			$registration->addNewUser();
			echo "user was added";
		}
		else {
			foreach ($registration->addNewUser() as $error) {
				echo $error . "<br />";
			}
		}
	}
}

if (isset($_POST['authorize'])) {
	__autoload('Authorization');

	if (isset($_POST['login'], $_POST['pass'])) {
		$authorization = new Authorization($_POST['login'], $_POST['pass']);
		if (!is_array($authorization->login())) {
			$authorization->login();
			header('Location: ' . DIRSEP . 'blog' . DIRSEP . 'my');
		}
		else {
			//var_dump($authorization->login());
			foreach ($authorization->login() as $error) {
				echo $error . "<br />";
			}
		}
	}
}


__autoload('User');