<?php
/**
* DB Connection
*/
class DB
{
	private static $conn = null;
	
	public static function getConn()
	{
		if (self::$conn === null) {
			self::$conn = new PDO('mysql:host=localhost;dbname=my_blog;', 'root', '');
		}
		return self::$conn;
	}
}

try {
	$c = DB::getConn();
	$c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$c->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
	echo "Error. Please, read .log file";
	file_put_contents('../log/errors.txt', time() . ": " . $e->getMessage() . "<br />");
}
?>