<?php
/**
* 
*/
class User
{
	public static $user_id;

	public static function userId()
	{
		if (null !== $_SESSION['user_id']) {
			self::$user_id = $_SESSION['user_id'];
			//$c = DB::getConn();
			return self::$user_id;
		}
		else {
			return false;
		}
	}
}